<?php

namespace App\Policies;

use App\Models\User;

class UserProfilePolicy
{
    /**
     * Determine whether the user can update the profileUser.
     */
    public function update(User $user, User $profileUser): bool
    {
        return $user->id === $profileUser->id;
    }
}
