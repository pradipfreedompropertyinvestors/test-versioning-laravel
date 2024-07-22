<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDistrict extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'district_id', 'sub_district_name', 'sub_district_code', 'status'
    ];

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function state() {
        return $this->hasOneThrough(State::class, District::class, 'id', 'id', 'district_id', 'state_id');
    }
}
