<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class required_docs extends Model
{
    use HasFactory;
    protected $table = 'required_documents';
    protected $fillable = [
        'type',
        'documents',
        'required_id',
    ];
}
