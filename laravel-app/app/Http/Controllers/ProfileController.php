<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileImageRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Database\QueryException;
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
        $imagePath = $this->getImagePath($user);
        return view('profile.edit', compact('user', 'imagePath'));
    }

    /**
     * Update the profile.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        try {
            $this->userService->updateProfile($user, $request->all());

            $success = ['success' => 'Profile updated successfully'];
            return redirect()->route('profile.edit', $user->id)->with($success);
        } catch (QueryException $e) {
            if (is_array($e->errorInfo) && isset($e->errorInfo[1]) && $e->errorInfo[1] === 1062) {
                $error = ['email' => 'The email address is already in use. Please choose a different email.'];
                return redirect()->back()->withErrors($error);
            }

            $error = ['error' => 'An error occurred while updating your profile. Please try again later.'];
            return redirect()->back()->withErrors($error);
        }
    }

    /**
     * Show specific user profile.
     */
    public function show(int $userId): RedirectResponse|View
    {
        $user = User::with('posts.likes')->find($userId);

        if (!$user) {
            $error = ['error' => 'No user with that id found.'];
            return redirect()->back()->withErrors($error);
        }

        $likesCount = $user->posts->sum(function ($post) {
            return $post->likes->count();
        });

        /** @var User $user */
        $imagePath = $this->getImagePath($user);
        $authUser = auth()->user();
        return view('profile.show', [
            'authUser' => $authUser,
            'user' => $user,
            'likesCount' => $likesCount,
            'imagePath' => $imagePath,
        ]);
    }

    /**
     * Store the user's profile image.
     * 
     * @throws \Exception If an error occurs during profile image update.
     */
    public function store(UpdateProfileImageRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $this->userService->updateProfileImage($user, $request);

        $success = ['success' => 'Profile image uploaded successfully'];
        return redirect()->back()->with($success);
    }

    /**
     * Get the image path of the uploaded profile.
     * 
     * @throws \Exception If an error occurs during acuring file path.
     */
    private function getImagePath(User $user): string
    {
        return 'storage/' . ($user->media->last()->file_path ?? 'assets/images/user-solid.svg');
    }
}
