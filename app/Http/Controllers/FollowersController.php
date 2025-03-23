<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{

    public function follow (User $user){
        $follower=Auth::user();
        $follower->following()->attach($user->id);
        
        Notification::create([
            'user_id'=>$user->id,
            'sender_id'=>$user->id,
            'type'=>'follow',
            'message'=>$user->name . 'followed your tweet'
        ]);
        return back();
    }
    public function unfollow (User $user){
        $follower=Auth::user();
        $follower->following()->detach();
        return back();
    }
}
