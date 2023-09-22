<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;

class UserVerificationService
{
    public function isUserVerified($user)
    {
        if (!$user->is_verified) {
            auth()->logout(); // Log the user out if not verified
            throw ValidationException::withMessages(['email' => 'Your account is not verified.']);
        }

        return true; // Return true if the user is verified
    }
}
