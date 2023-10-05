<?php

namespace App\Services;

use App\Interfaces\ProfileServiceInterface;
use App\Models\User;
use App\Models\UserInformation;

class ProfileService implements ProfileServiceInterface
{
    /**
     * Update the profile.
     * @param User $user
     * @param array<mixed, mixed> $data
     */
    public function updateProfile(User $user, array $data): Void
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
