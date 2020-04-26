<?php


namespace App;

use App\Notifications\YouWereFollowed;

trait Followable
{
    public function follow(User $user)
    {
        $user->notify(new YouWereFollowed(current_user()));
        
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        //return $this->follows()->toggle($user);
        if ($this->following($user)) {
            return $this->unfollow($user);
        }

        return $this->follow($user);
    }


    public function following(User $user)
    {
        return (bool)$this->follows()->where('following_user_id', $user->id)->exists();
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id')->withTimestamps();
    }
}
