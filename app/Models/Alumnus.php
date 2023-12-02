<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnus extends Model
{
    use HasFactory;

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function camelotRecruitmentProcessStep()
    {
        return $this->hasOne(CamelotCandidateRecruitmentProcessStep::class, 'id', 'camelot_recruitment_process_step_id');
    }
}
