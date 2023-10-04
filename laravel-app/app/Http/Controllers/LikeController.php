<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPost;
use App\Services\LikeService;
use Illuminate\Http\RedirectResponse;

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
    public function like(UserPost $post): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $this->likeService->like($user, $post);

        $success = ['success' => 'Post liked successfully'];

        return redirect()->back()->with($success);
    }

    /**
     * For User to unlike the liked post.
     */
    public function unlike(UserPost $post): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $this->likeService->unlike($user, $post);

        $success = ['success' => 'Post unliked successfully'];
        return redirect()->back()->with($success);
    }
}
