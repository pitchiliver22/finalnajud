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
        'edp_code',
        'subject',
        '1st_quarter',           // Changed from '1st_quarter'
        '2nd_quarter',          // Changed from '2nd_quarter'
        '3rd_quarter',           // Changed from '3rd_quarter'
        '4th_quarter',          // Changed from '4th_quarter'
        'overall_grade',
        'status',
        'grade_id',
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