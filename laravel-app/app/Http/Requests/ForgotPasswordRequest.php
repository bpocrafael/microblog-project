<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
        ];
    }

    /**
     * Error messages for registration validation.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'The email address field is required.',
            'email.email' => 'The email address must be a valid email address.',
        ];
    }
}
