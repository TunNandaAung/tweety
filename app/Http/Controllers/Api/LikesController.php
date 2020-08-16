<?php

namespace App\Http\Controllers\Api;

class LikesController extends BaseApiController
{
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
