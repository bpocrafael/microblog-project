<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserPost;
use App\Models\PostLike;

class LikeService
{
    public function like(User $user, UserPost $post): void
    {
        $like = PostLike::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        if (!$like) {
            $like = new PostLike();
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            $like->save();
        }
    }

    public function unlike(User $user, UserPost $post): void
    {
        $like = $post->likes->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
        }
    }
}
