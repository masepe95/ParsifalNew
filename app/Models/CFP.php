<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CFP extends Model
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
        'company_name',
        'vat_number',
        'address',
        'city',
        'district',
        'postal_code',
        'manager_name',
        'manager_surname',
        'email',
        'phone',
        'social_fb',
        'social_ig',
        'social_li',
        'social_x',
        'description',
        'logo',
        'internship_enabled',
        'stage_enabled',
    ];
}
