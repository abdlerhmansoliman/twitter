<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use SebastianBergmann\CodeUnit\FunctionUnit;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'url', 
        'type',
        'bio',
        'link',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

    }
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function rootPosts()
    {
        return $this->posts()->rootPosts();  
    }

    public function follower(){
        return $this->belongsToMany(User::class,'followers','following_id','follower_id');
    }
    public function following(){
        return $this->belongsToMany(User::class,'followers','follower_id','following_id')->select('users.id');
    }
    public function isFollowing(user $user){
        return $this->following()->where('following_id',$user->id)->exists();
    }
   
    public function followersCount (){
        return $this->follower()->count();
    }
    public function FollowinCount(){
        return $this->following()->count();
    }
    public function likes()
    {
         return $this->hasMany(Like::class, 'post_id');
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
    }
    public function image(){
        return $this->morphOne(Upload::class,'uploadable')->where('type','profile');
    }
    public function coverImage(){
        return $this->morphOne(Upload::class,'uploadable')->where('type','cover');
    }  
      public Function getImageUrlAttribute(){
        if($this->image && !empty($this->image->url)){
            return asset('storage/' . $this->image->url);
        }
        $email=trim(strtolower($this->email));
        $hash=md5($email);
        return "https://www.gravatar.com/avatar/$hash?d=mp&s=200";
    } 

    public function getCoverUrlAttribute()
    {
        if ($this->coverImage && !empty($this->coverImage->url)) {
            return asset('storage/' . $this->coverImage->url);
        }
        
        return "https://via.placeholder.com/1200x400/cccccc/ffffff?text=No+Cover+Image";
    }
    public function retweets(){
        return $this->belongsToMany(Post::class,'retweets');

    }
     public function followinPost(){
        return Post::whereIn('user_id', $this->following()->pluck('id')->toArray())
        ->latest() 
         ;

     }
     public function bookmarks()
     {
         return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id')->withTimestamps();
     }
     public function suggestedUsers(){
        return User::where('id', '!=', $this->id)
        ->whereNotIn('id',$this->following()->pluck('id')->toArray())
        ->inRandomOrder()
        ->limit(3)
        ->get();  
     }
     public function customNotifications()
     {
         return $this->morphMany(Notification::class, 'notifiable');
     }
     
}
