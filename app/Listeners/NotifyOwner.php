<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ReceivedNewReply;

class NotifyOwner implements ShouldQueue
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
        
        $owner = $this->getOwner($event);
     
        $owner
            ->notify(new ReceivedNewReply($event->reply->tweet, $event->reply, $isTweet = !$hasParent));
    }

    public function shouldQueue($event)
    {
        $owner = $this->getOwner($event);
        
        return $event->reply->owner->isNot($owner);
    }

    public function getOwner($event)
    {
        $hasParent = $event->reply->parent_id !== null;

        $owner = $hasParent ?  $event->reply->parent->owner :  $event->reply->tweet->user;
        
        return $owner;
    }
}
