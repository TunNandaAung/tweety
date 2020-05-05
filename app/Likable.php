<?php


namespace App;

use Illuminate\Database\Eloquent\Builder;
use App\Notifications\TweetWasLiked;
use App\Notifications\TweetWasDisliked;

trait Likable
{
    protected static function bootLikable()
    {
        static::deleting(function ($model) {
            $model->likes->each->delete();
        });
    }

    // public function scopeWithLikes(Builder $query, $id = null)
    // {
    //     $id ?
    //     $query->leftJoinSub(
    //         "select tweet_id,sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id having tweet_id = {$id}",
    //         'likes',
    //         'likes.tweet_id',
    //         'tweets.id'
    //     ) :
            
    //     $query->leftJoinSub(
    //         'select tweet_id,sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
    //         'likes',
    //         'likes.tweet_id',
    //         'tweets.id'
    //     );
    // }

    public function getLikesCountAttribute()
    {
        return $this->likes->where('liked', true)->count();
    }

    public function getDislikesCountAttribute()
    {
        return $this->likes->where('liked', false)->count();
    }

    public function isDisliked()
    {
        return (bool) $this->likes
            ->where('user_id', auth()->id())
            ->where('liked', false)
            ->count();
    }

    public function getIsDislikedAttribute()
    {
        return $this->isDisliked();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'liked');
    }

    public function isLiked()
    {
        return (bool) $this->likes
            ->where('user_id', auth()->id())
            ->where('liked', true)
            ->count();
    }

    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }

    public function dislike($user = null)
    {
        if ($this->isDisliked()) {
            return $this->removeLike($user);
        }

        return $this->like($user, false);
    }

    public function like($user = null, $liked = true)
    {
        if ($this->isLiked() && $liked) {
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
