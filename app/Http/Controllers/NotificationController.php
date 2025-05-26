<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NotificationController extends Controller
{
public function index(){
    $user = Auth::user();

    $notifications = $user->notifications()->latest()->take(10)->get(); // كل الإشعارات
    $unreadCount = $user->unreadNotifications->count();
    return Inertia::render('Notify/Index', [
        'notifications' => $notifications,
        'user' => $user,
        'unreadCount' => $unreadCount,
    ]);
}
}
