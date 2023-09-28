<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    protected $userService;

    public function __construct(ProfileService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function edit($profile)
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        
        try {
            $this->userService->updateProfile($user, $request->all());

            return redirect()->route('profile.edit', $user->id)->with('success', 'Profile updated successfully');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                $error = ['email' => 'The email address is already in use. Please choose a different email.'];
                return redirect()->back()->withErrors($error);
            }

            $error = ['error' => 'An error occurred while updating your profile. Please try again later.'];
            return redirect()->back()->withErrors($error);
        }
    }
}
