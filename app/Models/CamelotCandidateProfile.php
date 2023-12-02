<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCandidateProfile extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'user_profiles';
}
