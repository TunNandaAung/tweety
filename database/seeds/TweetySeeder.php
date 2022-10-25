<?php

use App\Tweet;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Schema;

class TweetySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->users()->tweets();

        Schema::enableForeignKeyConstraints();
    }

    public function users()
    {
        User::truncate();

        collect([
            [
                'name' => 'John Doe',
                'username' => 'johndoe',
                'email' => 'john@example.com',
                'password' => 'password'
            ],
            [
                'name' => 'Darth Vader',
                'username' => 'vader',
                'email' => 'vader@example.com',
                'password' => 'password'
            ],
            [
                'name' => 'Luke Skywalker',
                'username' => 'luke',
                'email' => 'luke@example.com',
                'password' => 'password'
            ],
            [
                'name' => 'Indiana Jones',
                'username' => 'rotla1981',
                'email' => 'indy@example.com',
                'password' => 'password'
            ],
            [
                'name' => 'Ben Solo',
                'username' => 'KyloRen',
                'email' => 'kylo@example.com',
                'password' => 'password'
            ],
            [
                'name' => 'Marty McFly',
                'username' => '121gigawatts',
                'email' => 'calvin@example.com',
                'password' => 'password'
            ],
        ])->each(function ($user) {
            factory(User::class)->create(
                [
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'password' => 'password'
                ]
            );
        });

        return $this;
    }

    public function tweets()
    {
        Tweet::truncate();

        $users = User::all();

        $users->each(function ($user) {
            factory(Tweet::class, 3)->create(['user_id' => $user->id]);
        });
    }
}
