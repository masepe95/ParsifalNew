<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationEvent extends Model
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
        'course_id',
        'tutor_id',
        'banner',
        'course_type_id',
        'start_date',
        'end_date',
        'max_students',
        'actual_price',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function task() //TODO: ??
    {
        return $this->hasOne(Task::class);
    }

}
