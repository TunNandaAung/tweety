<?php

namespace Tests\Feature;

use App\Notifications\YouWereFollowed;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Notification;

class FollowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_follow_other_user()
    {
        Notification::fake();

        $follower = create(User::class);

        $following = create(User::class);

        $this->signIn($follower);
        $this->post(route('follows', ['user' => $following]));

        $this->assertCount(1, $following->followers);
        Notification::assertSentTo($following, YouWereFollowed::class);
    }

    /** @test */
    public function a_user_can_unfollow_other_user()
    {
        Notification::fake();

        $follower = create(User::class);

        $following = create(User::class);

        $this->signIn($follower);

        $this->post(route('follows', ['user' => $following]));
        $this->assertCount(1, $following->followers);

        $this->post(route('follows', ['user' => $following]));
        $this->assertCount(0, $following->fresh()->followers);
    }
}
