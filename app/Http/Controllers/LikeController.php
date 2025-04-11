<?php

namespace App\Http\Controllers;

use App\Events\PostLikedEvent;
use App\Events\TweetLiked;
use App\Models\Notification;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post){
        $user=Auth::user();
        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->where('user_id', $user->id)->delete();


        }
        else{
            $post->likes()->create([
                'user_id'=>$user->id,
                'post_id'=>$post->id,
            ]);
            event(new PostLikedEvent(auth()->user(),$post));

        }
        return back();
    }

}
