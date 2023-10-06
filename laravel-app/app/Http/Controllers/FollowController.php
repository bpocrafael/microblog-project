<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class FollowController extends Controller
{
    public function follow(User $user): RedirectResponse
    {
        /** @var User $authUser */
        $authUser = auth()->user();
        
        $authUser->following()->attach($user);

        $success = ['success' => 'Successfully followed ' . $user->username];

        return redirect()->back()->with($success);
    }

    public function unfollow(User $user): RedirectResponse
    {
        /** @var User $authUser */
        $authUser = auth()->user();
    
        $authUser->following()->detach($user);

        $success = ['success' => 'Successfully unfollowed ' . $user->username];

        return redirect()->back()->with($success);
    }
}
