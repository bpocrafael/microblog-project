<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'content' => 'required|max:255',
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
            'content.required' => 'The comment content is required.',
            'content.max' => 'The comment content cannot exceed 255 characters.',
        ];
    }
    
}
