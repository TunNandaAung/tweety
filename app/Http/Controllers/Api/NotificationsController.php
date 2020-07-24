<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;

class NotificationsController extends BaseApiController
{
    public function index()
    {
        $unreadNotifications = auth()->user()->notifications;
        //return $readNotifications;
        auth()->user()->unreadNotifications->markAsRead();

        return $this->sendResponse($unreadNotifications);
    }
}
