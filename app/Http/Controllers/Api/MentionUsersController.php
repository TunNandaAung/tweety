<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;

class MentionUsersController extends BaseApiController
{
    public function __invoke()
    {
        $search = request('username');
        
        return current_user()->follows()
            ->where('username', 'LIKE', "%$search%")
            ->take(5)
            ->get();
    }
}
