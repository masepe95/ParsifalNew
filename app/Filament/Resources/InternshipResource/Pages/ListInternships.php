<?php

namespace App\Filament\Resources\InternshipResource\Pages;

use App\Filament\Resources\InternshipResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListInternships extends ListRecords
{
    protected static string $resource = InternshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'In Attesa' => Tab::make()
//                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('parsifal_enrolled_at')),
                ->modifyQueryUsing(fn (Builder $query) => $query->where('internship_status_id', '<', STARTED)),
            'Iscritti' => Tab::make()
//                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('parsifal_enrolled_at')),
                ->modifyQueryUsing(fn (Builder $query) => $query->where('internship_status_id', '>=', STARTED)),
        ];
    }
}
