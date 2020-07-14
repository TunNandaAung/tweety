<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\User;

class ExploreController extends BaseApiController
{
    public function __invoke()
    {
        return $this->sendResponse(
            User::inRandomOrder()->limit(15)->get()
        );
    }
}
