<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'In Gestione' => Tab::make()
                //->modifyQueryUsing(fn (Builder $query) => $query->whereNull('parsifal_enrolled_at')),
                ->modifyQueryUsing(fn (Builder $query) => $query->where('student_status_id', '<', ENROLLED)),
            'Iscritti' => Tab::make()
                //->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('parsifal_enrolled_at')),
                ->modifyQueryUsing(fn (Builder $query) => $query->where('student_status_id', '>=', ENROLLED)),
        ];
    }
}
