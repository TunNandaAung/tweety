<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Tweet;

class TweetLikesController extends BaseApiController
{
    public function store(Tweet $tweet)
    {
        $result = $tweet->like(current_user());

        if (!$result instanceof \App\Like) {
            return $this->sendResponse($this->removeResponse());
        }
        return $this->sendResponse($this->likeResponse());
    }

    public function destroy(Tweet $tweet)
    {
        $result = $tweet->dislike(current_user());
        
        if (!$result instanceof \App\Like) {
            return $this->sendResponse($this->removeResponse());
        }
        return $this->sendResponse($this->dislikeResponse());
    }

    public function likeResponse()
    {
        return [
            'liked' => true,
            'disliked' => false,
            'removed' => false,
        ];
    }

    
    public function dislikeResponse()
    {
        return [
            'liked' => false,
            'disliked' => true,
            'removed' => false,
        ];
    }

    
    public function removeResponse()
    {
        return [
            'liked' => false,
            'disliked' => false,
            'removed' => true,
        ];
    }
}
