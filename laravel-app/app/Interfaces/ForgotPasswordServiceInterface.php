<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

interface ForgotPasswordServiceInterface
{
    /**
     * Send a reset link to the email.
     * @param  array<string> $validatedData
     */
    public function sendResetLink(array $validatedData): RedirectResponse;

    /**
     * Reset the password.
     * @param  array<string> $validatedData
     */
    public function reset(User $user, array $validatedData): RedirectResponse;
}
