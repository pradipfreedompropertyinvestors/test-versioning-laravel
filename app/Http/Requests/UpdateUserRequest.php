<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateUserRequest extends FormRequest
{
    public function authorize() {
        return true; // Adjust based on your authorization logic
    }

    public function rules() {
        $user = $this->route('user');
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'mobile_number' => ['required', 'digits:10', 'unique:users,mobile_number,' . $user->id],
            'username' => ['required', 'string', 'lowercase', 'max:50', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'lowercase', 'max:50', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8'],
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
