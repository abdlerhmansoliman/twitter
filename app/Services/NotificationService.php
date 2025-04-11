<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
class NotificationService{
    public static function notifyOnce(Model $notifiable , string $notificationClass , array $data , \Closure $makeNotification){
        
        $alreadyNotified=$notifiable->notifications()
        ->where('type',$notificationClass)
        ->where('data->'.$data['key'],$data['value'])
        ->exists();
        if(!$alreadyNotified){
            $notifiable->notify($makeNotification());
        }
    }
}