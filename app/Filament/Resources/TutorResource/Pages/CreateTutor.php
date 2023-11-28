<?php

namespace App\Filament\Resources\TutorResource\Pages;

use App\Filament\Resources\TutorResource;
use App\Models\Branch;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class CreateTutor extends CreateRecord
{
    protected static string $resource = TutorResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        try {
            $branch = Branch::where('user_id', '=', auth()->id())->first();
            $data['branch_id'] = $branch->id;
            return static::getModel()::create($data);
        }
        catch(Exception $e){
            return('an error occurred: ' . $e->getMessage());
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
