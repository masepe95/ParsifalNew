<?php

namespace App\Filament\Resources\FormationEventResource\Pages;

use App\Filament\Resources\FormationEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormationEvents extends ListRecords
{
    protected static string $resource = FormationEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
