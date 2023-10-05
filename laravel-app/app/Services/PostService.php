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
}
