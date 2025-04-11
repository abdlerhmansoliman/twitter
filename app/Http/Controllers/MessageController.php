<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index (){
        $user=Auth::user();
        $authId=auth()->id();

        Message::where('receiver_id', $authId)
        ->where('is_read', false)
        ->update(['is_read' => true]);

        $chatIds=Message::where('sender_id',$authId)
        ->orWhere('receiver_id',$authId)
        ->get()
        ->flatMap(function($message) use ($authId){
        return [$message->sender_id, $message->receiver_id];
        })
        ->filter(function($id) use($authId){
            return $id != $authId;
        })
        ->unique()
        ->values();
        $chatUsers = User::whereIn('id', $chatIds)->get();
        

        return view('chat.index', compact('chatUsers','user'));
    }


    public function show($userId){

        $receiver=User::findOrFail($userId);
        $user=Auth::user();
        Message::where('sender_id', $userId)
        ->where('receiver_id', Auth::id())
        ->whereNull('read_at')
        ->update(['read_at' => now()]);
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id',Auth::id())
            ->where('receiver_id',$userId);
             })->orWhere(function ($query) use($userId){
             $query->where('sender_id',$userId)
             ->where('receiver_id',Auth::id());    
             })->orderBy('created_at')->get();
             
        
            return view('chat.show',compact('messages','receiver','user'));
        }

        public function store(MessageRequest $request){

            Message::create([
                'sender_id'=>Auth::id(),
                'receiver_id'=>$request->receiver_id,
                'message'=>$request->message
            ]);
            return redirect()->back();
        }
    }

