<?php

namespace App\Services;

use App\Http\Requests\UpdateProfileImageRequest;
use App\Interfaces\ProfileServiceInterface;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\UserMedia;
use Illuminate\Http\UploadedFile; 

class ProfileService implements ProfileServiceInterface
{
    /**
     * Update the profile.
     * @param User $user
     * @param array<mixed, mixed> $data
     */
    public function updateProfile(User $user, array $data): Void
    {
        $userInfo = $user->information;

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

    /**
     * Update the profile image.
     * @param User $user
     * @param UpdateProfileImageRequest $request
     */
    public function updateProfileImage(User $user, UpdateProfileImageRequest $request): void
    {
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            if ($file instanceof UploadedFile){
                $fileName = time() . '_' . $file->getClientOriginalName();

                $file->storeAs('public/profile_images', $fileName);

                $userMedia = new UserMedia([
                    'user_id' => $user->id,
                    'file_path' => 'profile_images/' . $fileName,
                    'file_name' => $fileName,
                ]);
                $userMedia->save();
            }
        }
    }
}
