<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubDistrictRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array {
        return [
            'sub_district_name' => 'required|string|max:100',
            'sub_district_code' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive',
            'district_id' => 'required|exists:districts,id'
        ];
    }
}
