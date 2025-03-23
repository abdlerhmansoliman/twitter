<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function mark(Post $post ){
        $user = Auth::user();
        if ($user->bookmarks()->where('post_id', $post->id)->exists()) {
            $user->bookmarks()->detach($post->id);
        } else {
            $user->bookmarks()->attach($post->id);
        }

        return back();
    }
    public function index(){
        $user= Auth::user();
        $tweets=$user->bookmarks()->latest()->get();
        return view('bookmarks.index',compact('tweets','user'));
    }   
}
