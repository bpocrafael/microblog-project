<?php

namespace App\Events;

use App\Models\UserPost;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostShared implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    use InteractsWithBroadcasting;

    public int $postId;
    public int $originalPostId;
    public string $message;
    public string $notificationUrl;
    public string $createdAt;

    /**
     * Create a new event instance.
     */
    public function __construct(
        int $postId,
        string $message,
        string $notificationId,
        string $createdAt,
    ) {
        $this->postId = $postId;
        $this->originalPostId = UserPost::find($postId)->original_post_id;
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
            new PrivateChannel('notification-channel.'.UserPost::find($this->originalPostId)->user_id),
        ];
    }
}
