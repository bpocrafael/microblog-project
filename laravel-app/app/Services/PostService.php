<?php

namespace App\Services;

use App\Events\PostShared;
use App\Interfaces\PostServiceInterface;
use App\Models\User;
use App\Models\UserPost;
use App\Notifications\ShareSucessful;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class PostService implements PostServiceInterface
{
    /**
     * To create a new post.
     * @param  array<string> $validatedData
     */
    public function createPost(User $user, array $validatedData): UserPost
    {
        /* @var \App\Models\User $user */
        $post = $user->posts()->create([
            'content' => $validatedData['content'],
        ]);

        return $post;
    }

    /**
     * To update an existing post.
     *
     * @param  array<string> $validatedData
     */
    public function updatePost(UserPost $post, array $validatedData): bool
    {
        try {
            $post->update([
                'content' => $validatedData['content'],
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * To reference an existing post as a new post.
     * @param  array<string> $validatedData
     */
    public function sharePost(UserPost $post, array $validatedData): UserPost
    {
        $authUser = auth()->user();

        $sharedPost = new UserPost();
        $sharedPost->content = $validatedData['content'];
        $sharedPost->original_post_id = $post->id;

        if ($post->isShared()) {
            $sharedPost->original_post_id = $post->original_post_id;
        }

        $sharedPost->user_id = auth()->user()->id;
        $sharedPost->save();

        if ($post->user_id === $authUser->id) {
            return $sharedPost;
        }

        try {
            $message = $authUser->username . ' shared your post';
            $postUser = User::find($post->user_id);
            $postUser->notify(new ShareSucessful($sharedPost->id, $message));
            $latestNotification = $postUser->notifications()->latest()->first();
            PostShared::dispatch(
                $sharedPost->id,
                $message,
                $latestNotification->id,
                $latestNotification->created_at->format('m/d/y  h:i a'),
            );
        } catch (\Exception $e) {
            Log::error('Comment event/notif failed: ' . $e->getMessage() . $postUser . $message . $latestNotification);
        }

        return $sharedPost;
    }

    /**
     * To update the image on post
     */
    public function isPostImageUpdatable(UserPost $post, UploadedFile $image): bool
    {
        try {
            if ($image != null) {
                $imagePath = $image->store('images', 'public');
                $userId = optional($post->user)->id;

                $post->media()->updateOrCreate(
                    [
                        'user_id' => $userId,
                    ],
                    [
                        'file_path' => $imagePath,
                    ],
                );
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * To add an image on post
     */
    public function addPostMedia(User $user, UserPost $post, UploadedFile $image): bool
    {
        if ($image == null) {
            return false;
        }

        $imagePath = $image->store('images', 'public');

        $post->media()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'file_path' => $imagePath,
        ]);

        return true;
    }

    public function deletePost(UserPost $post): void
    {
        $post->delete();
    }
}
