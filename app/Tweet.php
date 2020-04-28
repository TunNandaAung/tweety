<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events\TweetWasPublished;
use App\Reply;

class Tweet extends Model
{
    use Likable;

    
    protected $appends = ['is_liked','is_disliked'];
    
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($tweet) {
            event(new TweetWasPublished($tweet));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getBodyAttribute($body)
    {
        return \Purify::clean($body);
    }

    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
            '/@([\w\-\.]+)/',
            '<a href="/profiles/$1" class="text-blue-500 hover:underline">$0</a>',
            $body
        );
    }

    public function getThreadedReplies()
    {
        return $this->Replies()->with('owner')->get()->threaded();
    }
   

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        // event(new ThreadReceivedNewReply($reply));

        return $reply;
    }
}
