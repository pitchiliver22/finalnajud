<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section_schedules extends Model
{
    use HasFactory;
    protected $table = 'section_schedules';
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
        'time',
        'days',
    ];
}
