<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Support\Facades\Route;

class FollowsController extends BaseApiController
{
    public function store(User $user)
    {
        $user = tap(auth()->user())->toggleFollow($user);

        return $this->sendResponse($user);
    }

    public function show(User $user)
    {
        if (Route::currentRouteName() === 'api-show-following') {
            return $this->showFollowing($user);
        }

        return $this->showFollowers($user);
    }

    public function showFollowers($user)
    {
        return $this->sendResponse(
            $user->followers()->jsonPaginate(15)
        );
    }


    public function showFollowing($user)
    {
        return $this->sendResponse(
            $user->follows()->jsonPaginate(15)
        );
    }
}
