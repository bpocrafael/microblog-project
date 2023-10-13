<?php

namespace App\Interfaces;

use App\Models\User;

interface ProfileServiceInterface
{
    /**
     * @param  array<string> $data
     */
    public function updateProfile(User $user, array $data): Void;
}
