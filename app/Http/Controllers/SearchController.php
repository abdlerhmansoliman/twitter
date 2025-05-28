<?php

namespace App\Http\Controllers;

use App\Helpers\PostHelper;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function search(Request $request){
        $user=Auth::user();
        $query = $request->input('query');
        if (!$query) {
            return redirect()->back()->with('error', 'يرجى إدخال كلمة للبحث');
        }
        $users = User::where('name', 'LIKE', "%{$query}%")->get();
        $posts = Post::where('post', 'LIKE', "%{$query}%")
        ->with('user','replies','retweetedby','likes','bookmark')
        ->get();
         $posts = PostHelper::injectIsLiked($posts, $user);
        return Inertia::render('Search/Index', compact('users', 'posts', 'query','user'));
}
}