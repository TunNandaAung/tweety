<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ReceivedNewReply;

class NotifyOwner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $hasParent = $event->reply->parent_id !== null;

        $replyOwner = $event->reply->parent->owner;

        $tweetOwner = $event->reply->tweet->user;
        
        $owner = $hasParent ? $replyOwner : $tweetOwner;
        
        if ($owner->is($tweetOwner) || $owner->is($replyOwner)) {
            return;
        }

        $owner
        ->notify(new ReceivedNewReply($event->reply->tweet, $event->reply, $isTweet = !$hasParent));
    }
}
