<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPost;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    protected LikeService $likeService;

    /**
     * Controller setup
     */
    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    /**
     * For User to like a post.
     */
    public function like(UserPost $post): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $this->likeService->like($user, $post);

        $success = ['success' => 'Post liked successfully'];

        return response()->json([
            'status' => 'success',
            'success' => $success,
        ], 200);
    }

    /**
     * For User to unlike the liked post.
     */
    public function unlike(UserPost $post): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $this->likeService->unlike($user, $post);

        $success = ['success' => 'Post unliked successfully'];

        return response()->json([
            'status' => 'success',
            'success' => $success,
        ], 200);
    }
}
