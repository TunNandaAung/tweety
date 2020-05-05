<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;

class ReplyLikesController extends Controller
{
    public function store(Reply $reply)
    {
        return $reply->like(current_user());
    }

    public function destroy(Reply $reply)
    {
        return $reply->dislike(current_user());
    }
}
