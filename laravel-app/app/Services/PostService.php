<?php

namespace App\Services;

use App\Interfaces\PostServiceInterface;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Http\UploadedFile;

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
        $sharedPost = new UserPost();
        $sharedPost->content = $validatedData['content'];
        $sharedPost->original_post_id = $post->id;

        if ($post->isShared()) {
            $sharedPost->original_post_id = $post->original_post_id;
        }

        if (auth()->user()) {
            $sharedPost->user_id = auth()->user()->id;
        }

        $sharedPost->save();

        $post->save();

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

    /**
     * Delete image on post
     */

    public function deleteImage(UserPost $post): bool
    {
        if ($post->media) {
            if ($post->media->file_path) {
                $post->media()->delete();
                return true;
            }
        }
        return false;
    }
}
