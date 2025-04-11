<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        $user=Auth::user();
        $notifications=$user->unreadNotifications;
        $unreadCount=$user->unreadNotifications->count();
        $user->unreadNotifications->markAsRead();
        return view('notify.index',compact('notifications','user','unreadCount'));
    }
}
