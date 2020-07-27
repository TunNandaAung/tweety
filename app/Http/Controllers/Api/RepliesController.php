<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Reply;
use App\Tweet;
use Illuminate\Support\Facades\Gate;

class RepliesController extends BaseApiController
{
    public function index(Tweet $tweet)
    {
        return $this->sendResponse($tweet->getApiThreadedReplies());
    }

    public function show(Reply $reply)
    {
        return $this->sendResponse(
            $reply,
        );
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

        $reply['parent_id'] ? (int)$reply['parent_id']: $reply['parent_id'];

        return $this->sendResponse($reply, '', 201);
    }

    public function destroy(Reply $reply)
    {
        if (Gate::denies('edit', $reply->owner)) {
            return $this->sendError('Unauthorized!', [], 403);
        };

        $reply->delete();

        return $this->sendResponse([], 'Reply successfully deleted!', 200);
    }
}
