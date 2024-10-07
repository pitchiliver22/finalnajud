<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class previous_school extends Model
{
    use HasFactory;
    protected $table = 'previous_school';

    protected $fillable = [

        'second_school_name',
        'second_last_strand',
        'second_last_year_level',
        'second_school_year_from',
        'second_school_year_to',
        'second_school_type',

        'primary_school_name',
        'primary_last_year_level',
        'primary_school_year_from',
        'primary_school_year_to',
        'primary_school_type',

        'school_id',
    ];
}
