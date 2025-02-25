<?php

namespace App\Livewire;

use App\Models\Page;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;

class CreatePage extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;


    public $data = [];
    public $page;


    function mount($record)
    {
        $this->page = $record;
        $this->form->fill($this->page->data);
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

    public function save()
    {
        $state = $this->form->getState();

        $this->page->update([
            'data' => $state
        ]);
        $this->form->fill($this->page->data);
        Notification::make()
            ->success()
            ->title('Data Creation')
            ->body('Data Data Is Created Successfully')->send();
    }

    public
    function render()
    {
        return view('livewire.create-page');
    }
}
