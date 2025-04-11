<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['sender_id','receiver_id','message','is_read','read_at'];
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function recevier (){
        return $this->belongsTo(User::class,'receiver_id');
    }
}
