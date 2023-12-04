<?php

namespace App\Filament\Resources\CFPResource\Pages;

use App\Filament\Resources\CFPResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCFP extends EditRecord
{
    protected static string $resource = CFPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
