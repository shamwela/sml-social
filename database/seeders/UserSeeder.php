<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create separate seeders later
        // Create 2 users
        for ($count = 1; $count <= 2; $count++) {
            DB::table('users')->insert([
                'name' => Str::random(5),
                'email' => Str::random(5) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Make them friends
        DB::table('friend_users')->insert([
            'user_id' => 1,
            'friend_id' => 2,
        ]);

        DB::table('posts')->insert([
            'text' => 'Post of the user 2.',
            'user_id' => 2,
        ]);
    }
}
