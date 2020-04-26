<?php

function current_user()
{
    return auth()->user();
}

function get_notification_view($notificationType)
{
    $notificationView = Str::of($notificationType)->substr(18, Str::of($notificationType)->length());

    return $notificationView;
}

function get_notification_color($notificationType)
{
    $colors = [
        'App\Notifications\YouWereFollowed' => 'border-blue-400',
        'App\Notifications\YouWereMentioned' => 'border-purple-400',
        'App\Notifications\RecentlyTweeted' => 'border-teal-400'
    ];

    return $colors[$notificationType];
}
