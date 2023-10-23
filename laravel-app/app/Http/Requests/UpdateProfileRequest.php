<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $authUserId = auth()->user() ? auth()->user()->id : null;

        return [
            'username' => ['required', Rule::unique('users')->ignore($authUserId)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($authUserId)],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'middle_name' => ['nullable', 'string'],
            'bio' => ['nullable', 'string', 'max:140'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
        ];
    }

    /**
     * Error messages for registration validation.
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username has already been taken.',
            'email.required' => 'The email address field is required.',
            'email.email' => 'The email address must be a valid email address.',
            'email.unique' => 'The email address has already been taken.',
        ];
    }
}
