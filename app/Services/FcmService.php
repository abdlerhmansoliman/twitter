<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class FcmService
{

    public static function sendNotification($token,$data){
        $firebaseUrl = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = env('FCM_SERVER_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'key=' . $serverKey,
            'Content-Type' => 'application/json',
        ])->post($firebaseUrl, [
            'to' => $token,
            'notification' => [
                'title' => 'New Follower',
                'body' => $data['message'],
            ],
            'data' => $data,
        ]);

        return $response->successful();
    }

}