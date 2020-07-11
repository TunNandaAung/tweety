<?php

namespace App\Http\Controllers\Api;

use App\Tweet;
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

    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'image' => 'sometimes|nullable|image'
        ]);

        if (request('image')) {
            $attributes['image'] = request()->file('image')->store('tweet-images');
        }

        $attributes['user_id'] = auth()->id();

        $tweet = Tweet::create($attributes);

        return $this->sendResponse($tweet, '', 201);
    }
}
