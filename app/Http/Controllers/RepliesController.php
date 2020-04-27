<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class RepliesController extends Controller
{
    public function store(Tweet $tweet)
    {
        // return $tweet->addReply([
        //     'body' => request('body'),
        //     'user_id' => auth()->id()
        // ])->load('owner');
        $tweet->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
            'parent_id' => request('parent_id', null)
        ]);
        
        return back();
    }
}
