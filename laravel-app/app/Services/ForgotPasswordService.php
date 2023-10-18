<?php

namespace App\Services;

use App\Interfaces\ForgotPasswordServiceInterface;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordService implements ForgotPasswordServiceInterface
{
    /**
     * Send a reset link to the email.
     * @param  array<string> $validatedData
     */
    public function sendResetLink(array $validatedData): RedirectResponse
    {
        $status = Password::sendResetLink($validatedData);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Reset the password.
     * @param  array<string> $validatedData
     */
    public function reset(User $user, array $validatedData): RedirectResponse
    {
        $password = $validatedData['password'];
        $status = Password::reset(
            $validatedData,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            },
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
