<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\User;
use Illuminate\Support\Facades\Hash;

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
    public function unauthorized_users_cannot_edit_profile()
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
    public function authorized_users_can_edit_their_profiles()
    {
        $user = create(User::class);

        $this->actingAs($user)
            ->followingRedirects()
            ->patch($user->path(), $attributes =
                [
                    'username' => 'name',
                    'name' => 'Changed',
                    'description' => 'test',
                ])
            ->assertSee($attributes['username'])
            ->assertSee($attributes['name'])
            ->assertSee($attributes['description']);
    }

    /** @test */
    public function authorized_users_can_edit_their_passwords()
    {
        $user = create(User::class);

        $this->actingAs($user)
            ->patch(
                $user->path('password'),
                $attributes =
                [
                    'current_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                    'new_password' => 'password',
                    'new_password_confirmation' => 'password',
                ]
            );
        $this->assertTrue(Hash::check($attributes['new_password'], $user->fresh()->password));
    }

    /** @test */
    public function authorized_users_can_edit_their_emails()
    {
        $user = create(User::class);

        $this->actingAs($user)
            ->patch(
                $user->path('email'),
                $attributes =
                [
                   'email' => 'john@example.com'
                ]
            );
        $this->assertEquals($attributes['email'], $user->fresh()->email);
    }
}
