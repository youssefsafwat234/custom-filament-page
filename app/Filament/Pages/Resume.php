<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\Alignment;
use Psy\Util\Str;

class Resume extends Page implements HasForms
{
    use InteractsWithForms;

    public User $user;
    public $data;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.resume';


    public function mount()
    {
        $this->user = Filament::getCurrentPanel()->auth()->user();
        if ($record = $this->user->pages->where('type', \App\Models\Page::ABOUT)->first()) {
            $this->form->fill($record->data);
        }
    }

    public function form(Form $form): Form
    {
        return $form->schema(
            [
                Repeater::make('Education')
                    ->itemLabel(function (array $state) {
                        if ($state['course'] || $state['institute']) {
                            return \Illuminate\Support\Str::title($state['course']) . '(' . \Illuminate\Support\Str::title($state['institute']) . ')';
                        }
                    })
                    ->schema([
                        DatePicker::make('start_date')->native(false)->required(),
                        DatePicker::make('end_date')->native(false)->required(),
                        TextInput::make('course')->required(),
                        TextInput::make('institute')->required(),
                    ])->cloneable()->required()
                    ->columns(2),
            ]
        )->statePath('data');
    }

    function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')->submit('save')
        ];
    }


    function save()
    {

        if ($this->user->has('pages')) {
            $this->user->pages()->delete();
        }
        $state = $this->form->getState();

        \App\Models\Page::create([
            'user_id' => $this->user->id,
            'type' => 'about',
            'data' => $state
        ]);

        Notification::make()
            ->success()
            ->title('Resume Creation')
            ->body('Resume Data Is Created Successfully')->send();

    }
}
