<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleApiCall extends Model
{
    
    protected  $fillable = [
        'query',
        'result'
    ];
   
    /*
    public function dreamjobs(){
        return $this->hasMany(Dreamjob::class);
    }
    */
}
