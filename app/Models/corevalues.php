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
        'grade_level',
        'first',
        'second',
        'third', 
        'fourth',
        'core_id',
    ];
}
