<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResendEmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email-resend' => [
                'required',
                'email',
            ],
        ];
    }

    /**
     * Error messages for registration validation.
     *
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'email-resend.required' => 'The email address resent field is required.',
        ];
    }
}
