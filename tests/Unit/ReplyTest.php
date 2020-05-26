<?php

namespace Tests\Unit;

use App\Reply;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_has_an_owner()
    {
        $reply = factory(\App\Reply::class)->create();

        $this->assertInstanceOf(\App\User::class, $reply->owner);
    }

    /** @test */
    function it_has_a_path()
    {
        $reply = factory(\App\Reply::class)->create();

        $this->assertEquals(
            $reply->tweet->path() . "/replies/{$reply->id}",
            $reply->path
        );
    }

    /** @test */
    function it_wraps_mentioned_usernames_in_the_body_within_anchor_tags_with_correct_stylings()
    {
        $reply = new Reply([
            'body' => 'Hello @Jane-Doe'
        ]);

        $this->assertEquals(
            'Hello <a href="/profiles/Jane-Doe" class="text-blue-500 hover:underline">@Jane-Doe</a>',
            $reply->body
        );
    }
    /** @test */
    function a_reply_body_is_sanitized_automatically()
    {
        $reply = make(\App\Reply::class, ['body' => '<script>alert("bad")</script><p>This is okay.</p>']);

        $this->assertEquals("<p>This is okay.</p>", $reply->body);
    }

    /** @test */
    function it_can_have_children()
    {
        $parent = create(\App\Reply::class);

        create(\App\Reply::class, ['parent_id' => $parent->id], 2);

        $this->assertCount(2, $parent->children);
    }
}
