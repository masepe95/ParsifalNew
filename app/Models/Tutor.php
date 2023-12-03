<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'branch_id',
        'name',
        'surname',
        'description',
        'tutor_type_id',
        'email',
        'phone',
        'available_from',
        'available_until',
    ];

    public function tutorType()
    {
        return $this->belongsTo(TutorType::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
