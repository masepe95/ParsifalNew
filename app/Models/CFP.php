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
        'name',
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
        return $this->hasMany(Course::class,'cfp_id', 'id');
    }

    public function formationEvents()
    {
        return $this->hasManyThrough(
            FormationEvent::class,
            Branch::class,
            'cfp_id', // foreign key on branches table
            'branch_id', // foreign key on formation_events table
            'id', // local key on c_f_p_s table (main model table)
            'id'); // local key on branches table (intermediate model table)
    }

    public function alumni(){
        return $this->hasManyThrough(
            Alumnus::class,
            Branch::class,
            'cfp_id', // foreign key on branches table
            'branch_id', // foreign key on alumni table
            'id', // local key on c_f_p_s table (main model table)
            'id'); // local key on branches table (intermediate model table)
    }

    public function cfpType()
    {
        return $this->hasOne(CFPType::class);
    }

    public function cfpAccreditationType()
    {
        return $this->hasOne(CFPAccreditationType::class);
    }

    public function cfpFormationTypes()
    {
        return $this->belongsToMany(CFPFormationType::class);
    }

    public function cfpCourseTypes()
    {
        return $this->belongsToMany(CFPCourseType::class);
    }

    public function cfpAudienceTypes()
    {
        return $this->belongsToMany(CFPAudienceType::class);
    }

}
