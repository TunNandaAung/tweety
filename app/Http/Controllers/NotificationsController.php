<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $readNotifications = current_user()->notifications
                                        ->where('read_at', '!=', null)
                                        ->groupBy(function ($item) {
                                            return $item->created_at->format('d M y');
                                        });

        $unreadNotifications = current_user()->unreadNotifications
                                        ->groupBy(function ($item) {
                                            return $item->created_at->format('d M y');
                                        });
        //return $readNotifications;
        current_user()->unreadNotifications->markAsRead();

        return view('notifications.index', compact('readNotifications', 'unreadNotifications'));
    }
}
