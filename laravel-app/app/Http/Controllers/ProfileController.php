<?php

namespace App\Http\Controllers;

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
     *
     * @param ProfileService $userService
     * @return void
     */
    public function __construct(ProfileService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the profile page.
     *
     * @return View
     */
    public function index(): View
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    /**
     * Show the profile edit page.
     *
     * @param User $profile
     * @return View
     */
    public function edit($profile): View
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the profile.
     *
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        try {
            $this->userService->updateProfile($user, $request->all());

            return redirect()->route('profile.edit', $user->id)->with('success', 'Profile updated successfully');
        } catch (QueryException $e) {
            if (is_array($e->errorInfo) && isset($e->errorInfo[1]) && $e->errorInfo[1] === 1062) {
                $error = ['email' => 'The email address is already in use. Please choose a different email.'];
                return redirect()->back()->withErrors($error);
            }

            $error = ['error' => 'An error occurred while updating your profile. Please try again later.'];
            return redirect()->back()->withErrors($error);
        }
    }
}
