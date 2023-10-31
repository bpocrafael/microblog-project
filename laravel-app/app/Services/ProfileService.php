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
        DB::beginTransaction();

        try {
            if ($request->hasFile('profile_image')) {

                UserMedia::where('user_id', $user->id)->delete();

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

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Delete user's profile image
     */
    public function deleteProfileImage(UserMedia $userMedia): bool
    {
        DB::beginTransaction();

        try {
            $userMedia->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
