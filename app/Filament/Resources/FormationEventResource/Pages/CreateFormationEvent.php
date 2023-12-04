<?php

namespace App\Filament\Resources\FormationEventResource\Pages;

use App\Filament\Resources\FormationEventResource;
use App\Models\Branch;
use App\Models\CFP;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class CreateFormationEvent extends CreateRecord
{
    protected static string $resource = FormationEventResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        try {

            $currentUserId = auth()->id();
            $currentBranch = Branch::where('user_id', '=', $currentUserId)->first();

            $data['branch_id'] = $currentBranch->id;

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
