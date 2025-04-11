<?php

namespace App\View\Components;

use App\Models\Follower;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class newNotificationsBadge extends Component
{
    public $newNotificationsCount;
    public function __construct()
    {   
            $this->newNotificationsCount=Follower::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.new-notifications-badge');
    }
}
