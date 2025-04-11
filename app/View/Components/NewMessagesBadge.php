<?php

namespace App\View\Components;
use Illuminate\Support\Facades\Auth;

use App\Models\Message;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewMessagesBadge extends Component
{
   public $newMessagesCount;
    public function __construct()
    {
        $this->newMessagesCount = Message::where('receiver_id', Auth::id())
        ->where('is_read', false)
        ->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.new-messages-badge');
    }
}
