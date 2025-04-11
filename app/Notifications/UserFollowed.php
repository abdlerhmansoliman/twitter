<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;


class UserFollowed extends Notification
{
    use Queueable;

    protected $follower;
    protected $followed;

    public function __construct(User $follower , User $followed)
    {
        $this->follower = $follower;
        $this->followed = $followed;
    }
 

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database',];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->follower->name . ' followed you',
            'follower_id' => $this->follower->id,
        ];
    }

    /**
     * Get the FCM notification representation.
     */

}