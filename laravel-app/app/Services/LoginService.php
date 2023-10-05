<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Interfaces\LoginServiceInterface;
use Illuminate\Validation\ValidationException;

class LoginService implements LoginServiceInterface
{
    public function isAuthenticated(LoginRequest $request): bool
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
