<?php

namespace App\Observers;

use App\Models\User;

class isVerifiedObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updating(User $user): void
    {
        // Check if the email_verified_at attribute is dirty (changed)
        if ($user->isDirty('email_verified_at') && $user->email_verified_at !== null) {
            // Update the is_verified attribute to true
            $user->is_verified = true;
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
