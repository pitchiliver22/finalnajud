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

    // Define the relationship with the register_form model
    public function register()
    {
        return $this->belongsTo(register_form::class, 'details_id'); // Adjust 'details_id' if necessary
    }

    // Define the relationship with the address model
    public function address()
    {
        return $this->belongsTo(address::class, 'address_id'); // Ensure 'address_id' is the correct foreign key
    }

    // Define the relationship with the previous_school model
    public function previousSchool()
    {
        return $this->belongsTo(previous_school::class, 'school_id'); // Ensure 'school_id' is the correct foreign key
    }

    // Define the relationship with the required_docs model
    public function requiredDocs()
    {
        return $this->hasMany(required_docs::class, 'required_id'); // Ensure 'required_id' is the correct foreign key
    }
}