<?php

namespace App\Http\Controllers\Api;

use App\Chat;
use App\Message;

class MessagesController extends BaseApiController
{
    public function get(Chat $chat)
    {
        return $this->sendResponse(
            Message::where('chat_id', $chat->id)
            ->latest()
            ->paginate(20)
        );
    }
}
