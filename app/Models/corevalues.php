<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class corevalues extends Model
{
    use HasFactory;

    protected $table = 'core_values';
    protected $fillable = [
        'fullname',
        'section',
        'student_id',
        'respect',
        'excellence',
        'teamwork',
        'innovation',
        'sustainability',
    ];
}
