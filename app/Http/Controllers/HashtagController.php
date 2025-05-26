<?php

namespace App\Http\Controllers;

use App\Helpers\PostHelper;
use App\Models\Hashtag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function Termwind\render;

class HashtagController extends Controller
{
    public function show($hashtag){
        $user=Auth::user();
        $hashtag = Hashtag::where('name', $hashtag)->
        firstOrFail();
        $posts = $hashtag->posts()->with(
            'likes',
            'user',
            'image',
            'replies',
            'retweetedby',
            'bookmark'
        )->latest()->paginate(10);
            $posts = PostHelper::injectIsLiked($posts, $user);
        return Inertia::render('Hashtags/Index',compact('posts','user','hashtag'));   

    }
}
