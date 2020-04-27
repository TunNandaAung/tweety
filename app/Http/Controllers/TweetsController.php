<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TweetsController extends Controller
{
    protected $shouldFlash = false;
    
    public function index()
    {
        //session(['shouldFlash' => true]);
        //dd(Session::pull('shouldFlash'));
        // if (Session::pull('shouldFlash')) {
        //     Session::flash('flash', 'Your tweet has been published!');
        // }

        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }

    public function show(Tweet $tweet)
    {
        return view('tweets.show', ['tweet'=> $tweet, 'replies' => $tweet->getThreadedReplies()]);
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
        
        Tweet::create($attributes);
        

        if (request()->wantsJson()) {
            return ['message' => '/tweets'];
        }

        return redirect()->route('home')->with('flash', 'Your tweet has been published!');
    }

    public function destroy(Tweet $tweet)
    {
        $this->authorize('edit', $tweet->user);

        $tweet->delete();
        
        if (request()->wantsJson()) {
            //session(['shouldFlash' => true]);
            return ['message' => '/tweets'];
        }
        
        return redirect('/tweets');
    }
}
