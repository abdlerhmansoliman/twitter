<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = auth()->user()->notifications;
        return view('notifications.index', compact('notifications', 'user'));
    }

    public function markAsRead()
    {
        auth()->user()->notifications()->update(['is_read' => true]);
        return back();
    }
}
