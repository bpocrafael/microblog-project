<?php

namespace App\Services;

use App\Interfaces\PostServiceInterface;
use App\Models\User;
use App\Models\UserPost;

class PostService implements PostServiceInterface
{
    /**
     * To create a new post.
     * @param User $user
     * @param array<mixed, mixed> $validatedData
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
     * @param UserPost $post
     * @param array<string, mixed> $validatedData
     * @return bool
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
}
