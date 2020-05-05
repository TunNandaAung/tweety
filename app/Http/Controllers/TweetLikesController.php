<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetLikesController extends Controller
{
    public function store(Tweet $tweet)
    {
        return $tweet->like(current_user());
    }

    public function destroy(Tweet $tweet)
    {
        return $tweet->dislike(current_user());
    }
}
