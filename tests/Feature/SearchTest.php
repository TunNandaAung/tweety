<?php

namespace Tests\Feature;

use App\Tweet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_search_tweets()
    {
        $this->signIn();

        if (!config('scout.algolia.id')) {
            $this->markTestSkipped("Algolia is not configured.");
        }

        config(['scout.driver' => 'algolia']);

        create(Tweet::class, [], 2);
        create(Tweet::class, ['body' => 'A tweet with the foobar term.'], 2);

        do {
            // Account for latency.
            sleep(.25);

            $results = $this->getJson('/search?q=foobar')->json()['data'];
        } while (empty($results));

        $this->assertCount(2, $results);

        // Clean up.
        Tweet::latest()->take(4)->unsearchable();
    }
}
