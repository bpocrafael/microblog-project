<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex: /^(?=.*[A-Za-z])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*()_+{}[\]:;<>,.?~\\-]).{8,}$/',
            ],
        ];
    }

    /**
     * Error messages for reset password.
     *
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'The email address field is required.',
            'email.email' => 'The email address must be a valid email address.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long.',
        ];
    }
}
