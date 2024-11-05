<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_form extends Model
{
    use HasFactory;

    protected $table = 'payment_form';
    protected $fillable = [
        'fee_type',
        'amount',
        'payment_proof',
        'level',
        'payment_details',
        'payment_id',
        'status',
    ];


    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
}
