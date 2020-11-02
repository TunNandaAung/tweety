<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class MessageCollection extends Collection
{
    /**
     * Mark all messages as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        $this->each->markAsRead();
    }

    /**
     * Mark all messages as unread.
     *
     * @return void
     */
    public function markAsUnread()
    {
        $this->each->markAsUnread();
    }
}
