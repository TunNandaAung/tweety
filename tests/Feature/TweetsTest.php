<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Tweet;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RecentlyTweeted;

class TweetsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function guests_cannot_manage_tweets()
    {
        $tweet = create(\App\Tweet::class);

        $this->get('/tweets')->assertRedirect('login');
        $this->get($tweet->path())->assertRedirect('login');
        $this->post('/tweets', $tweet->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_tweet()
    {
        $this->signIn();

        $this->get('/tweets')->assertStatus(200);

        $this->followingRedirects()
            ->post('/tweets', $attributes = factory(Tweet::class)->raw())
            ->assertSee($attributes['body']);
    }

    /** @test */
    function a_photo_can_be_included_as_part_a_new_tweet_creation()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('POST', route('create-tweet'), [
            'body' => 'body',
            'image' => $file = UploadedFile::fake()->image('image.jpg')
        ]);

        Storage::disk('public')->assertExists('tweet-images/' . $file->hashName());
    }

    /** @test */
    function unauthorized_users_cannot_delete_tweets()
    {
        $tweet = create(Tweet::class);

        $this->delete($tweet->path())
            ->assertRedirect('/login');

        $user = $this->signIn();

        $this->delete($tweet->path())->assertStatus(403);
    }

    /** @test */
    function a_user_can_delete_a_project()
    {
        $tweet = create(Tweet::class);

        $this->actingAs($tweet->user)
            ->delete($tweet->path())
            ->assertRedirect('/tweets');

        $this->assertDatabaseMissing('tweets', $tweet->only('id'));
    }

    /** @test */
    public function a_tweet_requires_a_body()
    {
        $this->signIn();

        $attributes = factory('App\Tweet')->raw(['body' => '']);

        $this->post('/tweets', $attributes)->assertSessionHasErrors('body');
    }

    /** @test */
    function a_user_can_view_a_single_tweet()
    {
        $this->signIn();

        $tweet = create(Tweet::class);

        $this->get($tweet->path())
            ->assertSee($tweet->body);
    }

    /** @test */
    function a_user_can_see_all_replies_for_a_given_tweet()
    {
        $this->signIn();

        $tweet = create(Tweet::class);

        $reply = create(\App\Reply::class, ['tweet_id' => $tweet->id], 2);
        $response = $this->getJson($tweet->path() . '/replies')->json();

        $this->assertCount(2, $response['data']);
    }

    /** @test */
    function a_user_can_see_all_children_replies_for_a_given_tweet()
    {
        $this->signIn();

        $tweet = create(Tweet::class);

        $reply = create(\App\Reply::class, ['tweet_id' => $tweet->id]);
        $children = create(\App\Reply::class, ['tweet_id' => $tweet->id, 'parent_id' => $reply->id], 2);

        $response = $this->getJson("api/replies/{$reply->id}/children")->json();

        $this->assertCount(2, $response['data']);
    }

    /** @test */
    function a_user_timeline_includes_tweets_of_following_users()
    {

        Notification::fake();

        $user = create(\App\User::class);
        $creator = create(\App\User::class);

        $user->follow($creator);

        $tweet = create(Tweet::class, ['user_id' => $creator->id]);

        Notification::assertSentTo($user, RecentlyTweeted::class);

        $this->actingAs($user)
            ->get('/tweets')
            ->assertSee($tweet->body);
    }
}
