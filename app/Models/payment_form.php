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
        'payment_details',
        'payment_id',
    ];
}
