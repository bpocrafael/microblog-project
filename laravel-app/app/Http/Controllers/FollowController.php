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

        $message = 'Successfully followed ' . $user->username;

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], 200);
    }

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
