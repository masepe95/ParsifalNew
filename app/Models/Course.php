<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'cfp_id',
        'code',
        'topic',
        'description',
        'banner',
        'course_type_id',
        'list_price',
        'duration_hours',
        'available_from',
        'available_until',
    ];

    public function cfp()
    {
        return $this->belongsTo(CFP::class);
    }

    public function courseType()
    {
        return $this->belongsTo(Task::class);
    }

    // Temporary One-To-One relationship
    public function task()
    {
        return $this->hasOne(Task::class);
    }

    // To-Be Many-To-Many relationship
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

}
