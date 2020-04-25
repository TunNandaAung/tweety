<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = current_user()->notifications;
        //return $notifications;
        return view('notifications.index', compact('notifications'));
    }
}
