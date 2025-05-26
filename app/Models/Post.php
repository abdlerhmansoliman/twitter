<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable=['post','user_id','parent_id'];
protected $appends = ['image_url'];



    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeRootPosts($query)
    {
        return $query->whereNull('parent_id');
    }
    public function likes(){
        return $this->hasMany(Like::class,'post_id');
    }
    public function image(){
        return $this->morphOne(Upload::class,'uploadable')->where('type', 'image');
    }
    public function retweetedby()  {
        return $this->belongsToMany(User::class,'retweets');
    }
    public function bookmark()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id')->withTimestamps();
    }
    public function parent(){
        return $this->belongsTo(Post::class,'parent_id');
    }
    public function replies(){
    return $this->hasMany(Post::class, 'parent_id')->with('user', 'image');
    }
    public function hashtags(){
        return $this->belongsToMany(Hashtag::class);
    }
    public static  function  extractHashtags($text){
        preg_match_all('/#(\w+)/', $text, $matches);
        
        return $matches[1];
    }
    public function getImageUrlAttribute()
    {
        if ($this->image && !empty($this->image->url)) {
            return asset('storage/' . $this->image->url);
        }

        return null;
    }


}
