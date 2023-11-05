<?php

namespace App\Notifications;

use App\Models\PostComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class CommentSucessful extends Notification implements ShouldQueue
{
    use Queueable;
    protected int $postId;
    protected int $commentId;
    protected string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(int $commentId, string $message)
    {
        $this->postId = PostComment::find($commentId)->post_id;
        $this->commentId = $commentId;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'postId' => $this->postId,
            'commentId' => $this->commentId,
            'message' => $this->message,
        ];
    }
}
