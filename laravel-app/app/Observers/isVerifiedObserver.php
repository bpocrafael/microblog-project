<?php

namespace App\Observers;

use App\Models\User;

class isVerifiedObserver
{
    /**
     * Handle the User "updated" event.
     */
    public function updating(User $user): void
    {
        if ($user->isDirty('email_verified_at') && $user->email_verified_at !== null) {
            $user->is_verified = true;
        }
    }
}
