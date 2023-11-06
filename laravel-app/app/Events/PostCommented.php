<?php

namespace App\Events;

use App\Models\PostComment;
use App\Models\UserPost;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCommented implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    use InteractsWithBroadcasting;

    public int $postId;
    public int $commentId;
    public string $message;
    public string $notificationUrl;
    public string $createdAt;

    /**
     * Create a new event instance.
     */
    public function __construct(
        int $commentId,
        string $message,
        string $notificationId,
        string $createdAt,
    ) {
        $this->postId = PostComment::find($commentId)->post_id;
        $this->commentId = $commentId;
        $this->message = $message;
        $this->notificationUrl = route('notifications.markAsRead', $notificationId);
        $this->createdAt = $createdAt;

        $this->broadcastVia('pusher');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('notification-channel.'.UserPost::find($this->postId)->user_id),
        ];
    }
}
