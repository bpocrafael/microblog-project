<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ShareSucessful extends Notification implements ShouldQueue
{
    use Queueable;
    protected int $postId;
    protected string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(int $postId, string $message)
    {
        $this->postId = $postId;
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
            'message' => $this->message,
        ];
    }
}
