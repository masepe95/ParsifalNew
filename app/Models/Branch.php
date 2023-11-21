<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'cfp_id',
        'name',
        'description',
        'address',
        'city',
        'district',
        'postal_code',
        'gps_lat',
        'gps_lon',
        'manager_name',
        'manager_surname',
        'email',
        'phone',
    ];
}
