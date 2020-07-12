<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\LikesController;
use App\Reply;

class ReplyLikesController extends LikesController
{
    public function store(Reply $reply)
    {
        $result = $reply->like(current_user());

        if (!$result instanceof \App\Like) {
            return $this->sendResponse($this->removeResponse());
        }
        return $this->sendResponse($this->likeResponse());
    }

    public function destroy(Reply $reply)
    {
        $result = $reply->dislike(current_user());
        
        if (!$result instanceof \App\Like) {
            return $this->sendResponse($this->removeResponse());
        }
        return $this->sendResponse($this->dislikeResponse());
    }
}
