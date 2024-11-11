<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class register_form extends Model
{
    use HasFactory;
    protected $table = 'register_form';
    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'suffix',
        'email',
        'password',
        'status',
        'user_id'

    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';

    
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

