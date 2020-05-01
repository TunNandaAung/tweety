<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events\TweetWasPublished;
use App\Events\TweetReceivedNewReply;
use App\Reply;

class Tweet extends Model
{
    use Likable;

    
    protected $appends = ['is_liked','is_disliked','replies_count'];
    
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($tweet) {
            event(new TweetWasPublished($tweet));
        });

        static::deleting(function ($tweet) {
            $tweet->replies->each->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRepliesCountAttribute()
    {
        return $this->replies()->count();
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
        //return $this->replies()->paginate(3)->with('owner')->get()->threaded();
        //dd($this->replies()->with('allChildrenReplies')->get());
        return $this->replies()->with('owner')->whereNull('parent_id')->paginate(10);
    }
    
    public function showTweet()
    {
        return static::where('id', $this->id)->withLikes($this->id)->first();
    }

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        event(new TweetReceivedNewReply($reply));

        return $reply;
    }

    public function path()
    {
        return "/tweets/{$this->id}";
    }
}
