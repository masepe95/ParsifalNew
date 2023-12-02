<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCompanySearch extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'company_research_candidates';

    public function matches(){
        return $this->hasMany(CamelotCompanyMatch::class,  'company_research_id', 'id');
    }
}
