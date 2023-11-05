<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class FollowController extends Controller
{
    /**
     * Show all currently followers and following users
     */
    public function show(User $user): View
    {
        $followers = $user->followers()->orderBy('username')->get();
        $followings = $user->following()->orderBy('username')->get();

        return view('follow.show', [
            'user' => $user,
            'followers' => $followers,
            'followings' => $followings,
        ]);
    }

    /**
     * To follow the user.
     */
    public function update(User $user): JsonResponse
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        $authUser->following()->attach($user);

        $message = 'Successfully followed ' . $user->username;

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], 200);
    }

    /**
     * To unfollow the user.
     */
    public function destroy(User $user): JsonResponse
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        $authUser->following()->detach($user);

        $message = 'Successfully unfollowed ' . $user->username;

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], 200);
    }
}
