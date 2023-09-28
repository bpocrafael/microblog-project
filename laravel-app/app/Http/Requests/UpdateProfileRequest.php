<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'email' => ['required', 'email'],
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => ['nullable', 'string'],
            'bio' => ['nullable', 'string', 'max:140'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
        ];
    }
}
