<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class LikeSucessful extends Notification implements ShouldQueue
{
    use Queueable;
    protected int $postId;
    protected int $likerId;
    protected string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(int $postId, int $likerId, string $message)
    {
        $this->postId = $postId;
        $this->likerId = $likerId;
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
            'likerId' => $this->likerId,
            'message' => $this->message,
        ];
    }
}
