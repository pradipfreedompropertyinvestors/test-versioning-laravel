<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'district_name', 'district_code', 'state_id', 'status'
    ];

    // Define relationship with State model (if necessary)
    public function state() {
        return $this->belongsTo(State::class);
    }
}