<?php

namespace App\Services;

use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationService
{
    /**
     * Logic for registering users
     * @param array<string> $userData
     */
    public function registerUser(array $userData): void
    {
        $user = User::create([
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'username' => $userData['username'],
            'email_verification_code' => Str::random(40),
        ]);

        $user->information()->create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
        ]);

        Mail::to($userData['email'])->send(new EmailVerificationMail($user));

    }

    /**
     * Logic for verifying email
     */
    public function verifyEmail(string $verificationCode): bool
    {
        $user = User::where('email_verification_code', $verificationCode)->first();

        if (!$user || $user->email_verified_at) {
            return false;
        }

        return $user->update(['email_verified_at' => now()]);
    }

    /**
     * Logic for resending email
     */
    public function resendEmail(string $email): bool
    {
        $user = User::where('email', $email)->first();

        if (!$user || $user->email_verified_at) {
            return false;
        }

        $user->update([
            'email_verification_code' => Str::random(40),
        ]);

        Mail::to($email)->send(new EmailVerificationMail($user));

        return true;
    }
}
