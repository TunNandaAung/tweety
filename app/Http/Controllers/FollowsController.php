<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class FollowsController extends Controller
{
    // public function store(User $user)
    // {
    //     auth()->user()->toggleFollow($user);

    //     return back();
    // }

    public function store(User $user)
    {
        $user = auth()->user()->toggleFollow($user);

        return $user;
    }

    
    public function show(User $user)
    {
        if (Route::currentRouteName() == 'show-following') {
            return $this->showFollowing($user);
        }

        return $this->showFollowers($user);
    }

    public function showFollowers($user)
    {
        return view('follows.show', [
            'viewFollowers' => true,
            'username' => $user->username,
            'followings'=> $user->follows,
            'followers' => $user->followers,
        ]);
    }


    public function showFollowing($user)
    {
        return view('follows.show', [
            'viewFollowers' => false,
            'username' => $user->username,
            'followings'=> $user->follows,
            'followers' => $user->followers,
        ]);
    }
}
