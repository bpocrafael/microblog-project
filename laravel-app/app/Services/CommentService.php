<?php

namespace App\Services;

use App\Events\PostCommented;
use App\Http\Requests\CommentRequest;
use App\Models\PostComment;
use App\Models\User;
use App\Models\UserPost;
use App\Notifications\CommentSucessful;
use Illuminate\Support\Facades\Log;

class CommentService
{
    /**
     * Logic for storing comment
     * @return array<string, string|null>
     */
    public function storeComment(CommentRequest $request, UserPost $post): array
    {
        $authUser = auth()->user();
        if ($authUser->id === null) {
            return ['message' => 'Comment not added', 'comment' => null];
        }

        $comment = $post->comments()->create([
            'user_id' => $authUser->id,
            'comment' => $request->comment,
        ]);

        if ($post->user_id === $authUser->id) {
            return ['message' => 'Comment added successfully', 'comment' => $comment];
        }

        try {
            $message = $comment->user->username . ' commented on your post';
            $postUser = User::find($post->user_id);
            $postUser->notify(new CommentSucessful($comment->id, $message));
            $latestNotification = $postUser->notifications()->latest()->first();
            PostCommented::dispatch(
                $comment->id,
                $message,
                $latestNotification->id,
                $latestNotification->created_at->format('m/d/y  h:i a'),
            );
        } catch (\Exception $e) {
            Log::error('Comment event/notif failed: ' . $e->getMessage() . $postUser . $message . $latestNotification);
        }

        return ['message' => 'Comment added successfully', 'comment' => $comment];
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
