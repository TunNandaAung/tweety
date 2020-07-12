<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiBaseController;

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
