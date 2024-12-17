<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuarterSettings extends Model
{
    protected $table = 'quarter_settings';
    protected $fillable = [
        'first_quarter_enabled',
        'second_quarter_enabled',
        'third_quarter_enabled',
        'fourth_quarter_enabled',
        'quarter_status', 
    ];
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
}
