<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $fillable = [
        'fullname',
        'section',
        'grade_level',
        'edp_code',
        'subject',
        '1st_quarter',
        '2nd_quarter',
        '3rd_quarter',
        '4th_quarter',
        'month',
        'overall_attendance',
        'attendance_id',
    ];
}
