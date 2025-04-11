<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Illuminate\Notifications\Notification;


class PostLiked extends Notification
{
    use Queueable;

    public $liker;
    public $tweet;
    public function __construct($liker , $tweet)
    {
        $this->liker=$liker;
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
     * Get the mail representation of the notification.
     */


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message'=>$this->liker->name .'liked your tweet',
            'tweet_id'=>$this->tweet->id,
            'liker_id'=>$this->liker->id
        ];
    }
}
