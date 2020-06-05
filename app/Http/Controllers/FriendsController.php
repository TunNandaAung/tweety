<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index()
    {
        return cache()->rememberForever('friends.' . auth()->id(), function () {
            return auth()->user()->follows->take(10);
        });
    }
}
