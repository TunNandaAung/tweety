<?php

namespace Tests\Unit;

use App\Notifications\RecentlyTweeted;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Tweet;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->tweet = factory(\App\Tweet::class)->create();
    }

    /** @test */
    public function it_has_a_path()
    {
        $tweet = factory(\App\Tweet::class)->create();

        $this->assertEquals(
            "/tweets/{$tweet->id}",
            $tweet->path()
        );
    }
    /** @test */
    public function it_has_a_creator()
    {
        $this->assertInstanceOf(\App\User::class, $this->tweet->user);
    }

    /** @test */
    public function it_has_replies()
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
    public function it_wraps_mentioned_usernames_in_the_body_within_anchor_tags_with_correct_stylings()
    {
        $tweet = new Tweet([
            'body' => 'Hello @Jane-Doe'
        ]);

        $this->assertEquals(
            'Hello <a href="/profiles/Jane-Doe" class="text-blue-500 hover:underline">@Jane-Doe</a>',
            $tweet->body
        );
    }

    /** @test */
    public function it_wraps_webpage_url_in_the_body_within_anchor_tags_with_correct_stylings()
    {
        $tweet = new Tweet([
            'body' => 'Check at google.com and https://tunnandaaung.tech'
        ]);

        $this->assertEquals(
            'Check at <a href="google.com" class="text-blue-500 hover:underline">google.com</a> and <a href="https://tunnandaaung.tech" class="text-blue-500 hover:underline" target="_blank" rel="noreferrer noopener">https://tunnandaaung.tech</a>',
            $tweet->body
        );
    }

    /** @test */
    public function it_notifies_all_followers_when_published()
    {
        Notification::fake();

        $creator = create(\App\User::class);
        $firstFollower = create(\App\User::class);
        $secondFollower = create(\App\User::class);


        $firstFollower->follow($creator);
        $secondFollower->follow($creator);

        factory(\App\Tweet::class)->create(['user_id' => $creator->id]);


        Notification::assertSentTo([$firstFollower, $secondFollower], RecentlyTweeted::class);
    }
}
