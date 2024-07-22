<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'state_name',
        'state_code',
        'status'
    ];

    // Add relationships if needed
}

