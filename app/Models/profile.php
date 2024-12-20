<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
  
    protected $table = 'profile'; // Ensure this matches your migration
    protected $fillable = [
        'profile_picture',
        'user_id' // Change profile_id to user_id
    ];

    // Define a relationship to the User model (optional)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
