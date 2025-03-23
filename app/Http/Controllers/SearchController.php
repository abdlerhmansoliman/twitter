<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request){
        $user=Auth::user();
        $query = $request->input('query');
        if (!$query) {
            return redirect()->back()->with('error', 'يرجى إدخال كلمة للبحث');
        }
        $users = User::where('name', 'LIKE', "%{$query}%")->get();
        $posts = Post::where('post', 'LIKE', "%{$query}%")->get();
        return view('search.result', compact('users', 'posts', 'query','user'));
}
}