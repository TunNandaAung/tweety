<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;

class NotificationCountsController extends BaseApiController
{
    public function __invoke()
    {
        return $this->sendResponse([
            'notification_counts' => auth()->user()->unreadNotifications->count(),
        ]);
    }
}
