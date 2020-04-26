<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $readNotifications = current_user()->notifications->where('read_at', '!=', null);
        $unreadNotifications = current_user()->unreadNotifications;
        //return $notifications;
        return view('notifications.index', compact('readNotifications', 'unreadNotifications'));
    }
}
