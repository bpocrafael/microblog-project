<?php

namespace App\Services;

class UserVerificationService
{
    public function isUserVerified($user)
    {
        return $user->is_verified;
    }
}
