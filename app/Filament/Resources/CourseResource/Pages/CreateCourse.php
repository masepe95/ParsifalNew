<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use App\Models\CFP;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        try {
            $cfp = CFP::where('user_id', '=', auth()->id())->first();
            $data['cfp_id'] = $cfp->id;
            return static::getModel()::create($data);
        }
        catch(Exception $e){
            return('an error occurred: ' . $e->getMessage());
        }
    }

}
