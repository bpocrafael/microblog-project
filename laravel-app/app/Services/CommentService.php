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
            $message = "Comment with ID $id not found";
            return compact('message', 'comment');
        }

        $comment->delete();
        $message = "Comment with ID $id deleted from post {$comment->post_id}";

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
