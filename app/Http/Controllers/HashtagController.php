<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HashtagController extends Controller
{
    public function show($hashtag){
        $user=Auth::user();
        $hashtag = Hashtag::where('name', $hashtag)->firstOrFail();
        $posts = $hashtag->posts()->latest()->paginate(10);
        return view('hashtag.show',compact('hashtag','posts','user')); 

    }
}
