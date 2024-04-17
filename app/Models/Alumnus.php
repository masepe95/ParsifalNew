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

    public function camelotCandidate(){
        return $this->hasOne(CamelotCandidate::class, 'id','camelot_candidate_id');
    }

    public function camelotCandidateProfile(){
        return $this->hasOne(CamelotCandidateProfile::class, 'user_id','camelot_candidate_id');
    }

    public function camelotRecruitmentProcessStep()
    {
        return $this->hasOne(CamelotCandidateRecruitmentProcessStep::class, 'id', 'camelot_recruitment_process_step_id');
    }

    public function camelotCandidateStatus() // Va verificata
    {
        return $this->hasOneThrough(CamelotCandidateRecruitmentProcessStep::class, CamelotCandidate::class, 'id', 'id', 'camelot_candidate_id','camelot_recruitment_process_step_id');
    }

}
