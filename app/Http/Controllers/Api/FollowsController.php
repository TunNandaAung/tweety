<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Api\BaseApiController;

class FollowsController extends BaseApiController
{
    public function store(User $user)
    {
        $user = tap(auth()->user())->toggleFollow($user);

        return $this->sendResponse($user);
    }
}
