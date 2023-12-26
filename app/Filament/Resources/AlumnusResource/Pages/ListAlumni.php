<?php

namespace App\Filament\Resources\AlumnusResource\Pages;

use App\Filament\Resources\AlumnusResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListAlumni extends ListRecords
{
    protected static string $resource = AlumnusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->color("primary")
                ->visible(auth()->user()->role_id == BRANCH)
                ->use(\App\Imports\AlumniImport::class),
            //Actions\CreateAction::make(),
            Action::make('template')
                ->label('Scarica modello per import')
                ->url('/import/import_template.xlsx', true),
        ];
    }
}
