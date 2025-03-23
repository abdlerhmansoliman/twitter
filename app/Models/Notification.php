<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable=['user_id','sender_id','type','message','is_read','post_id'];
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
     }
     public function sender(){
        return $this->belongsTo(USer::class,'sender_id');
     }
     public function post(){
        return $this->belongsTo(Post::class,'post_id');
     }
     
}
