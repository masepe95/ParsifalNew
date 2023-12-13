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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class, 'cfp_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function cfpType()
    {
        return $this->hasOne(CFPType::class);
    }

    public function cfpFormationType()
    {
        return $this->hasOne(CFPFormationType::class);
    }

    public function cfpAccreditationType()
    {
        return $this->hasOne(CFPAccreditationType::class);
    }

    public function cfpCourseType()
    {
        return $this->hasOne(CFPCourseType::class);
    }

    public function cfpAudienceType()
    {
        return $this->hasOne(CFPAudienceType::class);
    }

}
