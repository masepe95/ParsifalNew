<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCandidateRecruitmentProcessStep extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'candidate_recruitment_process_steps';
}
