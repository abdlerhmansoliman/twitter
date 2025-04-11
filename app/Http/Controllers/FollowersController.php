<?php

namespace App\Http\Controllers;

use App\Events\UserFollowed;
use App\Events\UserFollowerEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{

    public function follow (User $user){
        $follower = Auth::user();
        $follower->following()->attach($user->id);
        logger('follow');
        event(new UserFollowerEvent($follower, $user));
        return back();
    }
    public function unfollow (User $user){
        $follower=Auth::user();
        $follower->following()->detach();
        return back();
    }
}
