<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersInformation;

class ProfileService
{
    public function updateProfile(User $user, array $data)
    {
        $userInfo = $user->users_information;

        if (!$userInfo) {
            $userInfo = new UsersInformation();
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
