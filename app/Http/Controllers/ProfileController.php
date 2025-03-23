<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(){
      $user=Auth::user()->load('image');
      $isOwner=true;
      $posts=$user->rootPosts()->get();      
      return view('profile.index',compact('user','isOwner','posts'));
    }

  public function show($id ){
    $user=User::findOrFail($id);
    $isOwner=Auth::check()&& Auth::id()===$user->id;

    $filter=request('filter');

    if($filter==='likes'){
        $posts=$user->likedPosts()->latest()->get();
    }

    else{
        $posts = $user->posts()->latest()->get();
    }

    return view('profile.index',compact('user','isOwner','posts','filter'));
  } 
}
