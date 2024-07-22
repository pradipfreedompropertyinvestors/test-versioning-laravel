<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistrictRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'district_name' => 'required|string|max:100',
            'district_code' => 'required|string|max:10',
            'state_id' => 'required|exists:states,id',
            'status' => 'required|in:active,inactive',
        ];
    }
}