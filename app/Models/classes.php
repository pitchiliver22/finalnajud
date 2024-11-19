<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    use HasFactory;
    protected $table = 'classes';
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
        'assign_id',
    ];

    const STATUS_PENDING = 'not assign';
    const STATUS_APPROVED = 'assigned';
}
