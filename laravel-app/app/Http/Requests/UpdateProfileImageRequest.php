<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
