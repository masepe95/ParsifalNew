<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCandidateMatch extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'candidate_matches';
}
