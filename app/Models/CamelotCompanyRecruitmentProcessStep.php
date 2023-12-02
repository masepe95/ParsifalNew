<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCompanyRecruitmentProcessStep extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'company_recruitment_process_steps';
}
