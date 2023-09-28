<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;

class UserVerificationService
{
    /**
     * Check if the user is verified.
     *
     * @param mixed $user
     * @return bool
     */
    public function isUserVerified($user): mixed
    {
        if (!$user->is_verified) {
            auth()->logout();
            throw ValidationException::withMessages(['email' => 'Your account is not verified.']);
        }

        return true;
    }
}
