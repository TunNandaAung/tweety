<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $chats = current_user()
                ->chats()
                ->latest('updated_at')
                ->get();
        
        return view('chat.index', compact('chats'));
    }

    public function show(User $user)
    {
        $chat = $this->findOrCreateChatRoom($user);
        
        $recipient = $user;

        $this->authorize('view', $chat);
        
        return view('chat.show', compact(['chat','recipient']));
    }


    public function findOrCreateChatRoom(User $user)
    {
        $chat =  auth()->user()->chats->filter(function ($chat) use ($user) {
            if ($chat->participants->contains($user)) {
                return $chat;
            }
        })->first();
       
        if (!$chat) {
            $chat = Chat::create();

            $chat->participants()->attach([auth()->id(),$user->id]);
        }

        return $chat;
    }
}
