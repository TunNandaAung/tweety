<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetDislikesController extends Controller
{
    public function store(Tweet $tweet)
    {
        $tweet->dislike(current_user());
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->removeDislike(current_user());
    }
}
