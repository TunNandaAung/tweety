<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;

class TweetsController extends BaseApiController
{
    public function index()
    {
        return $this->sendResponse(
            auth()->user()
                ->timeline()
                ->jsonPaginate()
        );
    }
}
