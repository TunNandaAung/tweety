<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetsController extends Controller
{
    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'image' => 'required|image'
        ]);
        
        if (request('image')) {
            $attributes['image'] = request()->file('image')->store('tweet-images');
        }

        $attributes['user_id'] = auth()->id();
        
        //Tweet::create($attributes);
        

        if (request()->wantsJson()) {
            return ['message' => $attributes];
        }

        return redirect()->route('home')->with('flash', 'Your tweet has been published!');
    }
}
