<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TweetReceivedNewReply
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;

    /**
     * Create a new event instance.
     *
     * @param \App\Reply $reply
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the subject of the event.
     */
    public function subject()
    {
        return $this->reply;
    }
}
