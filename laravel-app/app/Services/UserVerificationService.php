<?php

namespace App\Services;

use App\Interfaces\UserVerificationServiceInterface;
use App\Models\User;

class UserVerificationService implements UserVerificationServiceInterface
{
    /**
     * Check if the user is verified.
     *
     * @param User $user
     * @return bool
     */
    public function isUserVerified(User $user): mixed
    {
        if (!$user->is_verified) {
            auth()->logout();
            return false;
        }

        return true;
    }
}
