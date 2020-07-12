<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Reply;
use App\Tweet;

class RepliesController extends BaseApiController
{
    public function index(Tweet $tweet)
    {
        return $this->sendResponse($tweet->getApiThreadedReplies());
    }

    public function show(Reply $reply)
    {
        return $reply->children()->paginate(5);
    }

    public function jsonShow(Reply $reply)
    {
        return $this->sendResponse($reply->children()->jsonPaginate(5));
    }

    public function store(Tweet $tweet)
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
        ]);
        
        $reply = $tweet->addReply([
            'body' => $attributes['body'],
            'user_id' => auth()->id(),
            'parent_id' => request('parent_id', null)
        ]);

        return $this->sendResponse($reply, '', 201);
    }
}
