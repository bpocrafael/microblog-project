<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SharePostRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:140'],
        ];
    }
}
