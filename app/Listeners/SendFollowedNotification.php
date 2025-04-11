<?php

namespace App\Listeners;

use App\Events\UserFollowerEvent;
use App\Notifications\UserFollowed;
class SendFollowedNotification
{
    /**
     * Handle the event.
     */
    public function handle(UserFollowerEvent $event)
    {
        $event->followed->notify(new UserFollowed($event->follower, $event->followed));
    }
}