<?php

namespace App\Filament\Resources\BranchResource\Pages;

use App\Filament\Resources\BranchResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CFP;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class CreateBranch extends CreateRecord
{
    protected static string $resource = BranchResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        try {
            $branchUser = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => BRANCH,
            ]);

            unset($data['password']);
            $data['user_id'] = $branchUser->id;
            $cfp_id = CFP::where('user_id', '=', auth()->id())->first();
            $data['cfp_id'] = $cfp_id->id;

            return static::getModel()::create($data);
        }
        catch(Exception $e){
            return('an error occurred: ' . $e->getMessage());
        }
    }

}
