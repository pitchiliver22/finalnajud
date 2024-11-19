<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';

    protected $fillable = [
        'fullname',
        'section',
        'edp_code',
        'subject',
        'first_quarter',           // Changed from '1st_quarter'
        'second_quarter',          // Changed from '2nd_quarter'
        'third_quarter',           // Changed from '3rd_quarter'
        'fourth_quarter',          // Changed from '4th_quarter'
        'overall_grade',
        'status',
        'grade_id',
        'first_quarter_enabled',
        'second_quarter_enabled',
        'third_quarter_enabled',
        'fourth_quarter_enabled',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';

    public function getOverallGradeAttribute($value)
    {
        return number_format($value, 2);
    }

    public function setOverallGradeAttribute($value)
    {
        $this->attributes['overall_grade'] = floatval($value);
    }
}