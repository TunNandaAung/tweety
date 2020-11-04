<?php

namespace App\Events;

use App\Chat;
use App\User;
use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Carbon;

class MessageRead implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User that read the message
     *
     * @var \App\User
     */
    public $user;


    public $chat;

    public $read_at;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Chat $chat)
    {
        $this->user = $user;

        $this->chat = $chat;

        $this->read_at = Carbon::now();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chat.'.$this->chat->id);
    }
}
