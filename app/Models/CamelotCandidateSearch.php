<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCandidateSearch extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'dream_jobs';

    public function matches(){
        return $this->hasMany(CamelotCandidateMatch::class,  'dream_job_id', 'id');
    }
}
