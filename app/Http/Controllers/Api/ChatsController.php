<?php

namespace App\Http\Controllers\Api;

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
}
