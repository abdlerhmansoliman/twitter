<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\HashtageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\search;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/prolfile/{user}/follow',[FollowersController::class,'follow'])->name('user.follow');
    Route::post('/prolfile/{user}/unfollow',[FollowersController::class,'unfollow'])->name('user.unfollow');

    Route::get('/tweet',[PostController::class,'index'])->name('tweet.index');
    Route::post('tweet/',[PostController::class,'store'])->name('tweet.store');
    Route::get('/tweet/suggestions',[PostController::class,'suggestedUsers']);
    Route::post('/tweet/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::post('/retweet/{tweet}',[PostController::class,'retweet'])->name('post.retweet');
    Route::get('/tweet/{post}', [PostController::class, 'show'])->name('tweet.show');


    Route::get('/bookmarks',[BookmarkController::class,'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{post}',[BookmarkController::class,'mark'])->name('bookmark.mark');

    Route::get('/search',[SearchController::class,'search'])->name('search');

    Route::get('/trending',[PostController::class,'trending'])->name('tweet.trending');
    Route::get('/hashtag/{hashtag}',[HashtagController::class,'show'])->name('hashtag.show');   

    Route::get('/notification',[NotificationController::class,'index'])->name('notifications.index');

    
    // Route::get('/',[PostControler::class,'store']);
});

require __DIR__.'/auth.php';
    