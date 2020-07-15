<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\User;

class ExploreController extends BaseApiController
{
    public function __invoke()
    {
        return $this->sendResponse(
            User::all()->take(10)
        );
    }
}
