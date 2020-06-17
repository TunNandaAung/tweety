<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\User;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create(\App\User::class);

        $this->get($user->path())
            ->assertSee($user->username)
            ->assertSee($user->follows->count());
    }

    /** @test */
    function unauthorized_users_cannot_edit_profile()
    {
        $john = create(User::class);

        $jane = create(User::class);

        $this->get($john->path('edit'))
            ->assertRedirect('/login');

        $this->actingAs($jane)
            ->get($john->path('edit'))
            ->assertStatus(403);

        $this->actingAs($jane)
            ->patch($john->path(), $attributes = ['username' => 'name', 'name' => 'Changed'])
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_can_edit_their_profiles()
    {

        $user = create(User::class);

        $this->actingAs($user)
            ->followingRedirects()
            ->patch($user->path(), $attributes =
                [
                    'username' => 'name',
                    'name' => 'Changed',
                    'description' => 'test',
                    'email' => 'test@mail.com',
                    'password' => $user->password,
                    'password_confirmation' => $user->password,
                ])
            ->assertSee($attributes['username'])
            ->assertSee($attributes['name'])
            ->assertSee($attributes['description']);
    }
}
