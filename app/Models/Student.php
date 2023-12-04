<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'formation_event_id',
        'camelot_candidate_id',
        'email',
        'phone',
        'parsifal_enrolled_at',
        'status_id',
        'camelot_preregistration_email_sent_at',
        'origin_id',
    ];

    // To-Be Many-To-Many relationship
    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function formationEvent()
    {
        return $this->belongsTo(FormationEvent::class);
    }

    public function status()
    {
        return $this->hasOne(StudentStatus::class, 'id', 'student_status_id');
    }


}
