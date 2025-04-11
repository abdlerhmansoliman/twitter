<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
        'is_read',
    ];
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
    public function isRead()
    {
        return $this->read_at !== null;
    }
    
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }
}
