<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assign extends Model
{
    use HasFactory;
    protected $table = 'assign';
    protected $fillable = [
        'grade',
        'adviser',
        'section',
        'edpcode',
        'room',
        'subject',
        'description',
        'type',
        'unit',
        'startTime',
        'endTime',
        'days',
        'status',
        'class_id',
        'teacher_id'
    ];

    const STATUS_PENDING = 'not assign';
    const STATUS_APPROVED = 'assigned';
}
