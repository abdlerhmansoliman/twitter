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
  public function edit()
    { 
        $user = Auth::user();         
        return view('profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
      $user = Auth::user();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->bio = $request->bio;
      $user->link = $request->link;

      if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
    
        $user->image()->updateOrCreate([], [
            'url' => $path,
            'type' => 'profile',
        ]);
    }
    if ($request->hasFile('profile_image')) {
      $path = $request->file('profile_image')->store('profile_images', 'public');
  
      $user->image()->updateOrCreate([], [
          'url' => $path,
          'type' => 'profile',
      ]);
  }
      $user->save();
        return Redirect::route('profile.index')->with('success', 'Profile updated successfully.');
    }
}
