<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\MessageRead;
use App\Events\MessageSent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Chat $chat)
    {
        return Message::where('chat_id', $chat->id)
            ->latest()
            ->paginate(20);
    }

    public function store(Chat $chat, Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message,
            'chat_id' => $chat->id,
        ])->load('sender');
        
        $chat->messages()->attach($message);

        $chat->touch();

        broadcast(new MessageSent(auth()->user(), $message, $chat))->toOthers();

        return response(['status' => 'Message Sent!','message' => $message]);
    }

    public function update(Chat $chat, User $user)
    {
        $chat->senderMessages($user)
            ->get()
            ->markAsRead();
        
        broadcast(new MessageRead(auth()->user(), $chat))->toOthers();
            
        return ['status' => 'Mark as read'];
    }
}
