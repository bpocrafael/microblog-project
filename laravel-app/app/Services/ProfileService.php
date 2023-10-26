<?php

namespace App\Services;

use App\Http\Requests\UpdateProfileImageRequest;
use App\Interfaces\ProfileServiceInterface;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\UserMedia;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileService implements ProfileServiceInterface
{
    /**
     * Update the profile.
     * @param  array<string> $validatedData
     */
    public function updateProfile(User $user, array $validatedData): Void
    {
        /** @var UserInformation $userInfo */
        $userInfo = $user->information;

        $userInfo->update($validatedData);

        $user->update($validatedData);
    }

    /**
     * Update the profile image.
     */
    public function updateProfileImage(User $user, UpdateProfileImageRequest $request): void
    {
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            if ($file instanceof UploadedFile) {
                $fileName = time() . '_' . $file->getClientOriginalName();

                $file->storeAs('public/profile_images', $fileName);

                $userMedia = new UserMedia([
                    'user_id' => $user->id,
                    'file_path' => 'storage/profile_images/' . $fileName,
                    'file_name' => $fileName,
                ]);
                $userMedia->save();
            }
        }
    }

    /**
     * Delete user's profile image
     */
    public function deleteProfileImage(User $user): bool
    {
        DB::beginTransaction();

        try {
            $userMedia = UserMedia::where('user_id', $user->id)->first();

            if ($userMedia) {
                Storage::delete($userMedia->file_path);

                $userMedia->delete();

                DB::commit();
                return true;
            }

            return false;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
