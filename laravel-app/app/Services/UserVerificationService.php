<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;

class UserVerificationService
{
    public function isUserVerified($user)
    {
        if (!$user->is_verified) {
            auth()->logout();
            throw ValidationException::withMessages(['email' => 'Your account is not verified.']);
        }

        return true;
    }
}