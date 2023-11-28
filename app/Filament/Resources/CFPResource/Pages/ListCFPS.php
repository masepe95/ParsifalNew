<?php

namespace App\Filament\Resources\CFPResource\Pages;

use App\Filament\Resources\CFPResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCFPS extends ListRecords
{
    protected static string $resource = CFPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
