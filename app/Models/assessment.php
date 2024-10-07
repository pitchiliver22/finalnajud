<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assessment extends Model
{
    use HasFactory;
    protected $table = 'assessment';
    protected $fillable = [
        'school_year',
        'grade_level',
        'assessment_name',
        'description',
        'assessment_date',
        'assessmen_time',
        'assessment_fee',
    ];
}
