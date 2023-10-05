<?php

namespace App\Services;

use App\Interfaces\UserVerificationServiceInterface;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserVerificationService implements UserVerificationServiceInterface
{
    /**
     * Check if the user is verified.
     *
     * @param mixed $user
     * @return bool
     */
    public function isUserVerified(User $user): mixed
    {
        if (!$user->is_verified) {
            auth()->logout();
            throw ValidationException::withMessages(['email' => 'Your account is not verified.']);
        }

        return true;
    }
}
