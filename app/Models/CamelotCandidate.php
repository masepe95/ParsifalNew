<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCandidate extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'users';

    public function profile(){
        return $this->hasOne(CamelotCandidateProfile::class, 'user_id', 'id');
    }

    public function searches(){
        return $this->hasMany(CamelotCandidateSearch::class,  'user_id', 'id');
    }

    public function matches(){
        return $this->hasMany(CamelotCandidateMatch::class,  'user_id', 'id');
    }
}
