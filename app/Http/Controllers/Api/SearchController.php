<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Tweet;
use App\User;

class SearchController extends BaseApiController
{
    public function show()
    {
        $result = $this->mapSearchTypeToQuery(request('type'), request('q'));

        return $this->sendResponse($result);
    }

    public function mapSearchTypeToQuery($type, $query)
    {
        $model = [
            'tweet' => Tweet::search($query)->get(),
            'user' => User::search($query)->get(),
        ];

        return $model[$type];
    }
}
