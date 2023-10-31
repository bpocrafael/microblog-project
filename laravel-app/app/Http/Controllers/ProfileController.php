<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileImageRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\UserMedia;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    protected ProfileService $userService;

    /**
     * Create a new controller instance.
     */
    public function __construct(ProfileService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the profile edit page.
     */
    public function edit(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $imagePath = $user->image_path;
        return view('profile.edit', compact('user', 'imagePath'));
    }

    /**
     * Update the profile.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        /** @var User $user */
        $user = auth()->user();

        $this->userService->updateProfile($user, $validatedData);
        $success = ['success' => 'Profile updated successfully'];

        return redirect()->route('profile.show', $user->id)->with($success);
    }

    /**
     * Show specific user profile.
     */
    public function show(int $userId): RedirectResponse|View
    {
        $user = User::with('posts.likes')->find($userId);

        if ($user !== null) {
            $posts = $user->posts()
                ->orderBy('created_at', 'desc')
                ->paginate(4);
        }

        if (!$user) {
            $error = ['error' => 'No user with that id found.'];
            return redirect()->back()->withErrors($error);
        }

        /** @var User $user */
        $authUser = auth()->user();
        return view('profile.show', [
            'authUser' => $authUser,
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    /**
     * Store the user's profile image.
     */
    public function store(UpdateProfileImageRequest $request): JsonResponse
    {
        try {
            /** @var User $user */
            $user = auth()->user();
            $this->userService->updateProfileImage($user, $request);

            return response()->json(['message' => 'Profile image uploaded successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while uploading the profile image'], 500);
        }
    }

    /**
     * Delete user's profile image
     */
    public function destroy(User $user): RedirectResponse
    {
        $userMedia = UserMedia::where('user_id', $user->id)
        ->latest()
        ->first();

        if (!$userMedia) {
            return redirect()->back()->with('error', 'No profile image found to delete.');
        }

        if ($this->userService->deleteProfileImage($userMedia)) {
            return redirect()->back()->with('success', 'Profile image deleted successfully.');
        }

        return redirect()->back()->with('error', 'An error occurred while deleting the profile image.');
    }
}
