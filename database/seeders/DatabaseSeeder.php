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
        // Create separate seeders later
        // Create 2 users
        for ($count = 1; $count <= 2; $count++) {
            DB::table('users')->insert([
                'name' => 'User ' . $count,
                'email' => 'user' . $count . '@gmail.com',
                'password' => Hash::make('password')
            ]);
        }

        DB::table('posts')->insert([
            'text' => 'Post of user 2',
            'user_id' => 2
        ]);

        // Make them friends
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
