<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserPost;

class PostService
{
    public function createPost(User $user, array $validatedData) : UserPost
    {
		/* 
        * @var \App\Models\User $user
        * @param array<string, Item> $items
        */
        $post = $user->posts()->create([
            'content' => $validatedData['content'],
        ]);

        return $post;
    }
}
