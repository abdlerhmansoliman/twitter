<?php

namespace App\Http\Controllers;

use App\Helpers\PostHelper;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(){
      $user = Auth::user()->load('image')->loadCount(['follower', 'following']);
      $isOwner=true;
      $likedPostIds=$user->likedPosts()->pluck('post_id')->toArray();
      
      $posts = $user->posts()->with([
              'likes', 'user', 'image', 'replies', 'retweetedby', 'bookmark'
          ])
          ->where('parent_id',null)
         ->latest()->get();
            $posts = PostHelper::injectIsLiked($posts, $user);
            $likedCount = $user->likedPosts()->count();

         return Inertia::render('Profile/Index',compact('user','isOwner','posts','likedCount'));
    }

public function show($id)
{
    $user = User::findOrFail($id);
    $authUser = Auth::user();
    $isOwner = Auth::check() && Auth::id() === $user->id;
    $isFollowing = false;
      $likedPostIds=$user->likedPosts()->pluck('post_id')->toArray();

    if ($authUser && !$isOwner) {
        $isFollowing = $authUser->isFollowing($user);
    }

    $filter = request('filter');

    if ($filter === 'likes') {
        $posts = $user->likedPosts()
            ->with(['image','user', 'replies', 'likes', 'retweetedby', 'bookmark'])
            ->latest()
            ->get();
            $posts = PostHelper::injectIsLiked($posts, $user);
         } 
    else {
        $posts = $user->posts()
            ->with(['likes', 'user', 'image', 'replies', 'retweetedby', 'bookmark'])
            ->latest()
            ->get();
            $posts = PostHelper::injectIsLiked($posts, $user);

    }

    return Inertia::render('Profile/Index', compact('user', 'isOwner', 'posts', 'filter', 'isFollowing'));
}

  public function edit()
    { 
        $user = Auth::user();         
        return Inertia::render('Profile/Edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
      
      $user = Auth::user();
      if($request->filled('password')){
                if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'The provided password was incorrect.'])
                ->withInput();
        }
        $user->password = Hash::make($request->password);
      }
      
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
      if ($request->hasFile('cover_image')) {
          $path = $request->file('cover_image')->store('cover_images', 'public');
          $user->coverImage()->updateOrCreate([], [
              'url' => $path,
              'type' => 'cover',
          ]);
      }
      $user->save();
        return Redirect::route('profile.index')->with('message', 'Profile updated successfully.');
    }
            public function followers($id)
        {
            $user = User::withCount(['follower', 'following'])->findOrFail($id);
            $followers = $user->follower()->with('image')->get();
            return Inertia::render('Profile/Followers', [
                'user' => $user,
                'followers' => $followers,
            ]);
        }
             public function following($id)
        {
            $user = User::withCount(['follower', 'following'])->findOrFail($id);
            $followings = $user->following()->with('image',)->get();
            return Inertia::render('Profile/Followings', [
                'user' => $user,
                'followings' => $followings,
            ]);
        }
}
