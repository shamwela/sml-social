<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Sha Mwe La',
            'email' => 'shamwela@gmail.com',
            'password' => Hash::make('password')
        ]);

        DB::table('users')->insert([
            'name' => 'Steve Jobs',
            'email' => 'stevejobs@gmail.com',
            'password' => Hash::make('password')
        ]);

        DB::table('posts')->insert([
            'text' => 'Hi this is my app.',
            'user_id' => 1
        ]);

        DB::table('posts')->insert([
            'text' => 'Focus is about saying no.',
            'user_id' => 2
        ]);

        DB::table('posts')->insert([
            'text' => 'I wanna eat pizza.',
            'user_id' => 2
        ]);

        DB::table('likes')->insert([
            'user_id' => 1,
            'post_id' => 1
        ]);

        DB::table('comments')->insert([
            'user_id' => 1,
            'post_id' => 1,
            'text' => 'Test comment'
        ]);
        DB::table('comments')->insert([
            'user_id' => 2,
            'post_id' => 2,
            'text' => 'Test comment'
        ]);

        DB::table('friend_users')->insert([
            'user_id' => 1,
            'friend_id' => 2
        ]);

        DB::table('saved_posts')->insert([
            'user_id' => 1,
            'post_id' => 1
        ]);
    }
}
