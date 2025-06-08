<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ViewRecord;
use PrintFilament\Print\Infolists\Components\PrintComponent;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                PrintComponent::make("print_page")
                    ->label("Print Page")
                    ->columnSpanFull(),
                TextEntry::make('name')
                ,
                TextEntry::make('email')
                ,
                DateTimePicker::make('email_verified_at'),
                TextEntry::make('password')
                ,
            ]);
    }


}
