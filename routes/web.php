<?php
    //notifications firebase and send email 
    
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MessageController;


use Illuminate\Support\Facades\Route;




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
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

    Route::get('lang/{locale}',[LocaleController::class,'setLocale']);

    
    Route::get('/notifications',[NotificationController::class,'index'])->name('notify.index');

    Route::get('chats', [MessageController::class,'index'])->name('chat.index');
    Route::get('/chat/{userId}',[MessageController::class,'show'])->name('chat.show');
    Route::post('/chat/send',[MessageController::class,'store'])->name('chat.send');
    
});

require __DIR__.'/auth.php';
    