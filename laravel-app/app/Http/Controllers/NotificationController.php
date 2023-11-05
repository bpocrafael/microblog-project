<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    /**
     * To mark all unread notification of user as read.
     */
    public function markAllAsRead(): JsonResponse
    {
        $notifications = auth()->user()->notifications;

        if (!$notifications) {
            $message = ['error' => 'Unable to find notifications'];
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ], 404);
        }

        $notifications->markAsRead();

        $success = ['success' => 'All notifications marked as read successfully'];

        return response()->json([
            'status' => 'success',
            'success' => $success,
        ], 200);
    }

    /**
     * To mark a notification as read.
     */
    public function markAsRead(string $notificationId): RedirectResponse
    {
        $notification = auth()->user()->notifications->find($notificationId);

        if (!$notification) {
            $error = ['error' => 'Cannot find notification'];
            return redirect()->route('home')->with($error);
        }

        $notification->markAsRead();

        return redirect()->route('post.show', $notification->data['postId']);
    }
}
