<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
}
