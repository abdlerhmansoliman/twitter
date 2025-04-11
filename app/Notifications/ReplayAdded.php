<?php

namespace App\Notifications;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;

use Illuminate\Notifications\Notification;



class ReplayAdded extends Notification
{
    use Queueable;

    protected $replier;
    protected $tweet;
    public function __construct(User $replier , Post $tweet)
    {
        $this->replier=$replier;
        $this->tweet=$tweet;
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
            'message'=>$this->replier->name . ' replied to your tweet',
            'tweet_id'=>$this->tweet->id,
            'replier_id'=>$this->replier->id
        ];
    }
}
