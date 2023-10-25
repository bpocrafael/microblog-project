<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class FollowController extends Controller
{
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

    public function update(User $user): JsonResponse
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        $authUser->following()->attach($user);

        $success = ['success' => 'Successfully followed ' . $user->username];

        return response()->json(['success' => $success]);
    }

    public function destroy(User $user): JsonResponse
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        $authUser->following()->detach($user);

        $success = ['success' => 'Successfully unfollowed ' . $user->username];

        return response()->json(['success' => $success]);
    }
}
