<?php

namespace App\Http\Controllers;

use App\Helpers\PostHelper;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookmarkController extends Controller
{
    public function mark(Post $post ){
        $user = Auth::user();
        if ($user->bookmarks()->where('post_id', $post->id)->exists()) {
            $user->bookmarks()->detach($post->id);
        } else {
            $user->bookmarks()->attach($post->id);
        }

        return redirect()->back();
    }
    public function index(){
        $user= Auth::user();
       $tweets = $user->bookmarks()
    ->with('user')
    ->latest()
    ->get()
    ->map(function ($post) use ($user) {
        return $post->load([
        'likes',
        'user',        
        'image',
        'replies',     
        'retweetedby',
        'bookmark'
        ]);
    });;
        $tweets=PostHelper::injectIsLiked($tweets, $user);
        return Inertia::render('Bookmarks/Index',compact('tweets','user'));
    }   
}
