<?php

namespace Tests\Unit;

use App\Notifications\RecentlyTweeted;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->tweet = factory(\App\Tweet::class)->create();
    }

    /** @test */
    function a_tweet_has_a_path()
    {
        $tweet = factory(\App\Tweet::class)->create();

        $this->assertEquals(
            "/tweets/{$tweet->id}",
            $tweet->path()
        );
    }
    /** @test */
    function a_tweet_has_a_creator()
    {
        $this->assertInstanceOf(\App\User::class, $this->tweet->user);
    }

    /** @test */
    function a_tweet_has_replies()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->tweet->replies
        );
    }

    /** @test */
    public function a_reply_can_be_added_to_a_tweet()
    {
        $this->tweet->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->tweet->replies);
    }

    /** @test */
    function a_tweet_notifies_all_followers_when_published()
    {
        Notification::fake();

        $creator = factory(\App\User::class)->create();
        $follower = factory(\App\User::class)->create();

        $follower->follow($creator);

        factory(\App\Tweet::class)->create(['user_id' => $creator->id]);


        Notification::assertSentTo($follower, RecentlyTweeted::class);
    }
}
