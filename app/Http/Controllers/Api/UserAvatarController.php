<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiControllerController;
use Illuminate\Http\Request;

class UserAvatarController extends BaseApiController
{
    public function show()
    {
        return $this->sendResponse(['avatar' => auth()->user()->avatar]);
    }
}
