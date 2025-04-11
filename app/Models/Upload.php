<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable=['url', 'uploadable_id', 'uploadable_type', 'type'];
    
    public function uploadable() {
        return $this->morphTo();
    }
}
