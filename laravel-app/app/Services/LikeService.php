<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserPost;
use App\Models\PostLike;

class LikeService
{
    public function like(User $user, UserPost $post): void
    {
        $like = PostLike::updateOrCreate(
            ['user_id' => $user->id, 'post_id' => $post->id],
            ['user_id' => $user->id, 'post_id' => $post->id],
        );
    }

    public function unlike(User $user, UserPost $post): void
    {
        $like = $post->likes->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
        }
    }
}
