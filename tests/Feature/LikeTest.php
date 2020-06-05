<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_can_not_like_anything()
    {
        $this->withExceptionHandling()
            ->post('replies/1/like')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->post('tweets/1/like')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_like_any_reply()
    {
        $this->signIn();

        $reply = create(\App\Reply::class);

        $this->post(route('like-reply', $reply->id));

        $this->assertCount(1, $reply->likes->where('liked', true));
    }

    /** @test */
    public function an_authenticated_user_can_ldislike_any_reply()
    {
        $this->signIn();

        $reply = create(\App\Reply::class);

        $this->delete(route('dislike-reply', $reply->id));

        $this->assertCount(1, $reply->likes->where('liked', false));
    }

    /** @test */
    public function an_authenticated_user_can_like_any_tweet()
    {
        $this->signIn();

        $tweet = create(\App\Tweet::class);

        $this->post(route('like-tweet', $tweet->id));

        $this->assertCount(1, $tweet->fresh()->likes->where('liked', true));
    }

    /** @test */
    public function an_authenticated_user_can_dislike_any_tweet()
    {
        $this->signIn();

        $tweet = create(\App\Tweet::class);

        $this->delete(route('dislike-tweet', $tweet->id));

        $this->assertCount(1, $tweet->fresh()->likes->where('liked', false));
    }

    /** @test */
    function an_authenticated_user_can_toggle_like_and_dislike()
    {
        $this->signIn();

        $reply = create(\App\Reply::class);

        $this->post(route('like-reply', $reply->id));
        $this->post(route('like-reply', $reply->id));
        $this->assertCount(0, $reply->likes->where('liked', true));

        $this->delete(route('dislike-reply', $reply->id));
        $this->delete(route('dislike-reply', $reply->id));
        $this->assertCount(0, $reply->likes->where('liked', false));
    }
}
