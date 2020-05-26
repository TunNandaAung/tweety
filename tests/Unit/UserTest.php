<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testExample()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function a_user_can_determine_their_avatar_path()
    {
        $user = factory(\App\User::class)->create();

        $this->assertEquals(asset('images/default-avatar.png'), $user->avatar);

        $user->avatar = 'avatars/me.jpg';

        $this->assertEquals(asset('avatars/me.jpg'), $user->avatar);
    }

    /** @test */
    public function a_user_can_determine_their_banner_path()
    {
        $user = factory(\App\User::class)->create();

        $this->assertEquals(asset('images/default-profile-banner.jpg'), $user->banner);

        $user->banner = 'banners/my-banner.jpg';

        $this->assertEquals(asset('banners/my-banner.jpg'), $user->banner);
    }
}
