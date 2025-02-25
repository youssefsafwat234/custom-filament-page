<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EditPage extends Page
{
    public $record;
    protected static bool $shouldRegisterNavigation = false;


    public static function getSlug(): string
    {
        return 'page/edit/{id}';
    }


    function mount($id)
    {
        $this->record = \App\Models\Page::findOrFail($id);
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-page';

}
