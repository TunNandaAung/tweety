<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\User;

class ProfilesController extends BaseApiController
{
    public function index()
    {
        return $this->sendResponse(auth()->user());
    }

    public function show(User $user)
    {
        return $this->sendResponse($user);
    }
}
