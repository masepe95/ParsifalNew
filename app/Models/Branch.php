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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cfp()
    {
        return $this->belongsTo(CFP::class);
    }

    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }

    public function formationEvents()
    {
        return $this->hasMany(FormationEvent::class);
    }

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, FormationEvent::class);
    }

}
