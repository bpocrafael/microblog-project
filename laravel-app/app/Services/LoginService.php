<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function isAuthenticated(Request $request): bool
    {
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $field => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (auth()->attempt($credentials, $request->filled('remember'))) {
            return true;
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}
