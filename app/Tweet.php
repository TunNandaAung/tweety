<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use Likable;

    
    protected $appends = ['is_liked_by','is_disliked_by'];
    
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
