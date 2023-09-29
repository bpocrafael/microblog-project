<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserInformation;

class ProfileService
{
    /**
     * Update the profile.
     *
     * @param User $user
     * @param array<string, mixed> $data
     * @return void
     */
    public function updateProfile(User $user, array $data)
    {
        $userInfo = $user->user_information;

        if (!$userInfo) {
            $userInfo = new UserInformation();
        }

        $userInfo->fill([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'bio' => $data['bio'],
            'gender' => $data['gender'],
        ]);

        $userInfo->save();

        $user->update([
            'username' => $data['username'],
            'email' => $data['email'],
        ]);
    }
}
