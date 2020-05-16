<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Tweet;

class SimpleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($user) {
            factory(Tweet::class, 2)->create(['user_id' => $user->id]);
        });
    }
}
