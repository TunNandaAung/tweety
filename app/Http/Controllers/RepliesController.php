<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class RepliesController extends Controller
{
    public function index(Tweet $tweet)
    {
        return $tweet->getThreadedReplies();
    }

    public function store(Tweet $tweet)
    {
        // return $tweet->addReply([
        //     'body' => request('body'),
        //     'user_id' => auth()->id()
        // ])->load('owner');
        $attributes = request()->validate([
            'body' => 'required|max:255',
        ]);

        $tweet->addReply([
            'body' => $attributes['body'],
            'user_id' => auth()->id(),
            'parent_id' => request('parent_id', null)
        ]);
        
        if (request()->wantsJson()) {
            return ['message' => "/tweets/{$tweet->id}"];
        }

        return back();
    }
}
