<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Models\PostComment;
use App\Models\UserPost;

class CommentService
{
    /**
     * Logic for storing comment
     * @return array<string, string|null>
     */
    public function storeComment(CommentRequest $request, UserPost $post): array
    {
        if ($user = auth()->user()) {
            $comment = $post->comments()->create([
                'user_id' => $user->id,
                'comment' => $request->comment,
            ]);
            return ['message' => 'Comment added successfully', 'comment' => $comment];
        }
        return ['message' => 'Comment not added', 'comment' => null];
    }

    /**
     * Logic for deleting comment
     * @return array<string, string|null>
     */
    public function deleteComment(int $id): array
    {
        $comment = PostComment::find($id);

        if (!$comment) {
            return ['message' => 'Comment not found', 'comment' => null];
        }

        $post = $comment->post;

        if (!$post) {
            return ['message' => 'Post not found for the comment', 'comment' => null];
        }

        $user = $post->user;

        if (!$user) {
            return ['message' => 'User not found for the post', 'comment' => null];
        }

        $username = $user->username;
        $message = "Comment deleted from {$username}'" . (str_ends_with($username, 's') ? '' : 's') . " post";

        $comment->delete();

        return compact('message', 'comment');
    }


    /**
     * Logic for editing comment
     * @return array<string, string|null>
     */
    public function editComment(int $id, string $validatedData): array
    {
        $comment = PostComment::find($id);

        if ($comment) {
            $comment->comment = $validatedData;
            $comment->save();
            return ['message' => 'Comment edited successfully', 'comment' =>  $comment->comment];
        }
        return ['message' => 'Comment not edited', 'comment' => null];
    }
}
