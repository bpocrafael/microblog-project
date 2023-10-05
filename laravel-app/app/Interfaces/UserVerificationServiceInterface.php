<?php

namespace App\Interfaces;

use App\Models\User;

interface UserVerificationServiceInterface
{
    public function isUserVerified(User $user): mixed;
}
