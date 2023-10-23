<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;
use Illuminate\Http\UploadedFile;

interface PostServiceInterface
{
    /**
     * To create a new post of the user.
     * @param  array<string> $validatedData
     */
    public function createPost(User $user, array $validatedData): UserPost;

    /**
     * To update an existing post of the user.
     * @param  array<string> $validatedData
     */
    public function updatePost(UserPost $post, array $validatedData): bool;

    /**
     * To reference an exsiting post in a new post.
     * @param  array<string> $validatedData
     */
    public function sharePost(UserPost $post, array $validatedData): UserPost;

    /**
     * To update the image on post
     */
    public function isPostImageUpdatable(UserPost $post, UploadedFile $image): bool;
}
