<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tweet;
use App\ReplyCollection;

class Reply extends Model
{
    protected $guarded = [];

    protected $appends = ['path','children_count'];
    
    protected $with=['owner'];
    

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }
 
    public function newCollection(array $models = [])
    {
        return new ReplyCollection($models);
    }

    public function parent()
    {
        return $this->belongsTo(Reply::class, 'parent_id');
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


    public function children()
    {
        return $this->hasMany(Reply::class, 'parent_id', 'id')->with('owner');
    }

    public function getChildrenCountAttribute()
    {
        return $this->children()->count();
    }

    public function allChildrenReplies()
    {
        return $this->childrenReplies()->with('allChildrenReplies');
    }

    public function path()
    {
        $perPage = 3;

        $replyPosition = $this->tweet->replies()->pluck('id')->search($this->id) + 1;

        $page = ceil($replyPosition / $perPage);

        return $this->tweet->path()."#reply-{$this->id}";
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function scopeChildless($query)
    {
        $query->has('childrenReplies', '=', 0);
    }
}
