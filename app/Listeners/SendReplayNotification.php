<?php

namespace App\Listeners;

use App\Events\ReplayAddedEvent;
use App\Notifications\ReplayAdded;


class SendReplayNotification
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
    public function handle(ReplayAddedEvent $event): void
    {
        $event->tweet->user->notify(new ReplayAdded($event->replier , $event->tweet));
    }
}
