<?php


namespace App;

use Illuminate\Database\Eloquent\Builder;
use App\Notifications\TweetWasLiked;
use App\Notifications\TweetWasDisliked;

trait Likable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select tweet_id,sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function isDislikedBy(User $user)
    {
        return (bool)$user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', false)
            ->count();
    }

    public function getIsDislikedAttribute()
    {
        return (bool)current_user()->likes
            ->where('tweet_id', $this->id)
            ->where('liked', false)
            ->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user)
    {
        return (bool)$user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', true)
            ->count();
    }
   
    public function getIsLikedAttribute()
    {
        return (bool)current_user()->likes
            ->where('tweet_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function dislike($user = null)
    {
        if ($this->isDislikedBy($user = current_user())) {
            return $this->removeLike($user);
        }

        return $this->like($user, false);
    }

    public function like($user = null, $liked = true)
    {
        if ($this->isLikedBy($user = current_user()) && $liked) {
            return $this->removeLike($user);
        }
        
        $this->user->notify(
            $liked
            ? new TweetWasLiked($tweet = $this, current_user())
            : new TweetWasDisliked($tweet = $this, current_user())
        );
        
        return $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
        ], [
            'liked' => $liked,

        ]);
    }

    public function removeLike($user = null)
    {
        return $this->likes()->delete($user, null);
    }
}
