<?php

namespace App\Http\Controllers\Api;

use App\Chat;
use App\User;

class ChatsController extends BaseApiController
{
    public function index()
    {
        $chats = current_user()
                ->chats()
                ->latest('chats.updated_at')
                ->paginate(15);
        
        return $this->sendResponse($chats);
    }

    public function show(User $user)
    {
        $chat = $this->findOrCreateChatRoom($user);
        
        return $this->sendResponse($chat);
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
