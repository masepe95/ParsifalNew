<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamelotCompanyMatch extends Model
{
    use HasFactory;

    protected $connection = 'mysql_camelot';
    protected $table = 'company_matches';

    public function camelotCompanySearch(){
        return $this->belongsTo(CamelotCompanySearch::class,'company_research_id', 'id');
    }

}
