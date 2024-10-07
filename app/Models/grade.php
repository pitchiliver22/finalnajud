<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grade extends Model
{
    use HasFactory;
    protected $table = 'grade';
    protected $fillable = [
        'fullname',
        'section',
        'student_id',
        'edp_code',
        'subject',
        '1st_quarter',
        '2nd_quarter',
        '3rd_quarter',
        '4th_quarter',
        'overall_grade',
    ];
}
