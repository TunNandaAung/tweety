<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events\TweetWasPublished;

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
}
