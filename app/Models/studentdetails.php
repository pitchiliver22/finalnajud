<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentdetails extends Model
{
    use HasFactory;
    protected $table = 'studentdetails';
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'nationality',
        'gender',
        'civilstatus',
        'birthdate',
        'birthplace',
        'religion',
        'mother_name',
        'mother_occupation',
        'mother_contact',
        'father_name',
        'father_occupation',
        'father_contact',
        'guardian_name',
        'guardian_occupation',
        'guardian_contact',
        'details_id',
        'status'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
}
