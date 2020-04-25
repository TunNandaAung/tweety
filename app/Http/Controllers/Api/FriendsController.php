<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class FriendsController extends Controller
{
    public function index()
    {
        $search = request('username');
        
        return current_user()->follows()->where('username', 'LIKE', "%$search%")
            ->take(5)
            ->pluck('username')->map(function ($username) {
                return ['username' => $username];
            });
    }
}
