<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\EditRecord;
use PrintFilament\Print\Infolists\Components\PrintComponent;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

        ];
    }


}
