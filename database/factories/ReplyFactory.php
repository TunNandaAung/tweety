<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id'=>factory(App\User::class),
        'tweet_id' => factory(App\Tweet::class),
        'body'=>$faker->sentence,
        'parent_id' => null
    ];
});
