<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{


    public function index()
    {

        $tweets = Tweet::latest()->get();

        return view('home', [
            'tweets' => auth()->user()->timeline()
        ]);
    }

    public function store()
    {

        $attributes = request()->validate([
            'body' => 'required|max:255'
        ]);

        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body']
        ]);

        return redirect('home');
    }
}
