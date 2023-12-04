<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'branch_id',
        'camelot_company_id',
        'email',
        'phone',
        'parsifal_enrolled_at',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function status()
    {
        return $this->hasOne(InternshipStatus::class, 'id', 'internship_status_id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class);
    }

    public function camelotCompany()
    {
        return $this->hasOne(CamelotCompany::class, 'id', 'camelot_company_id');
    }

    public function camelotCompanyProfile()
    {
        return $this->hasOne(CamelotCompanyProfile::class, 'company_id', 'camelot_company_id');
    }

}
