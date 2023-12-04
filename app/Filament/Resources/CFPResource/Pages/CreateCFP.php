<?php

namespace App\Filament\Resources\CFPResource\Pages;

use App\Filament\Resources\CFPResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCFP extends CreateRecord
{
    protected static string $resource = CFPResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
