<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change this to your authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'mobile_number' => ['required', 'digits:10', 'unique:users'],
            'username' => ['required', 'string', 'lowercase','max:50', 'unique:users'],
            'email' => ['required', 'string', 'lowercase','max:50', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', 'in:active,inactive'],
            'role_id' => ['required', 'exists:roles,id']
        ];
    }

    public function messages() {
        return [
            'gender.in' => 'The selected gender is invalid.',
            'status.in' => 'The selected status is invalid.',
            'mobile_number.digits' => 'The mobile number must be exactly 10 digits.',
        ];
    }
}