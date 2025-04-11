<?php

namespace App\Providers;

use App\Events\PostLikedEvent;
use App\Events\ReplayAddedEvent;
use App\Events\UserFollowerEvent;
use App\Listeners\SendFollowedNotification;
use App\Listeners\SendPostLikedNotification;
use App\Listeners\SendReplayNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserFollowerEvent::class=>[SendFollowedNotification::class],
        PostLikedEvent::class=>[SendPostLikedNotification::class],
        ReplayAddedEvent::class=>[SendReplayNotification::class],

    ];

    public function boot()
    {
        
        parent::boot();
    }
}