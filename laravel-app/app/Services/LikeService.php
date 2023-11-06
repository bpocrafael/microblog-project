<?php

namespace App\Services;

use App\Events\PostLiked;
use App\Models\User;
use App\Models\UserPost;
use App\Models\PostLike;
use App\Notifications\LikeSucessful;
use Illuminate\Support\Facades\Log;

class LikeService
{
    public function like(User $user, UserPost $post): void
    {
        PostLike::updateOrCreate(
            ['user_id' => $user->id, 'post_id' => $post->id],
        );

        if ($user->id === $post->user->id) {
            return;
        }

        try {
            $message = $user->username . ' liked your post';
            $postUser = User::find($post->user->id);
            $postUser->notify(new LikeSucessful($post->id, $user->id, $message));
            $latestNotification = $postUser->notifications()->latest()->first();
            PostLiked::dispatch(
                $post->id,
                $user->id,
                $message,
                $latestNotification->id,
                $latestNotification->created_at->format('m/d/y  h:i a'),
            );
        } catch (\Exception $e) {
            Log::error('Like event/notif failed: ' . $e->getMessage());
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
