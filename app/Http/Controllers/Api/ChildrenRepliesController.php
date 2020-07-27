<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Reply;

class ChildrenRepliesController extends BaseApiController
{
    public function show(Reply $reply)
    {
        return $reply->children()->paginate(5);
    }

    public function jsonShow(Reply $reply)
    {
        return $this->sendResponse($reply->children()->jsonPaginate(5));
    }
}
