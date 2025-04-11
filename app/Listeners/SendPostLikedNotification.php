<?php

namespace App\Listeners;

use App\Events\PostLikedEvent;
use App\Notifications\PostLiked;


class SendPostLikedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostLikedEvent $event): void
    {   
        $event->tweet->user->notify(new PostLiked($event->liker,$event->tweet));
    }
}
