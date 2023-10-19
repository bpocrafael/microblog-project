<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Models\PostComment;
use App\Models\UserPost;

class CommentService
{
    /**
     * Logic for storing comment
     */
    public function storeComment(CommentRequest $request, UserPost $post): void
    {
        if ($user = auth()->user()) {
            $post->comments()->create([
                'user_id' => $user->id,
                'comment' => $request->comment,
            ]);
        }
    }

    /**
     * Logic for deleting comment
     */
    public function deleteComment(int $id): void
    {
        if ($comment = PostComment::find($id)) {
            $comment->delete();
        }
    }

    /**
     * Logic for editing comment
     */
    public function editComment(int $id, string $validatedData): void
    {
        if ($comment = PostComment::find($id)) {
            $comment->comment = $validatedData;
            $comment->save();
        }
    }
}
