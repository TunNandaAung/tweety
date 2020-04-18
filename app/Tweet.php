<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use Likable;

    
    protected $appends = ['is_liked','is_disliked'];
    
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
