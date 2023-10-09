<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FollowController extends Controller
{
    /**
     * To display all the followers-following of the user
     */
    public function show(User $user): View
    {
        $followers = $user->followers()->get();
        $followings = $user->following()->get();

        return view('follow.show', [
            'user' => $user,
            'followers' => $followers,
            'followings' => $followings,
        ]);
    }

    /**
     * To follow other user account.
     */
    public function update(User $user): RedirectResponse
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        $authUser->following()->attach($user);

        $success = ['success' => 'Successfully followed ' . $user->username];

        return redirect()->back()->with($success);
    }

    /**
     * To unfollow a user account.
     */
    public function destroy(User $user): RedirectResponse
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        $authUser->following()->detach($user);

        $success = ['success' => 'Successfully unfollowed ' . $user->username];

        return redirect()->back()->with($success);
    }
}
