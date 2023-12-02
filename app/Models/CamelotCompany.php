<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCompany extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'companies';

    public function profile(){
        return $this->hasOne(CamelotCompanyProfile::class, 'company_id', 'id');
    }

    public function matches(){
        return $this->hasMany(CamelotCompanyMatch::class,  'company_id', 'id');
    }

    public function searches(){
        return $this->hasMany(CamelotCompanySearch::class,  'company_id', 'id');
    }
}

