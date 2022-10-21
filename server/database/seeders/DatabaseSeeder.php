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
            'email' => 'shamwela@shamwela.com',
            'password' => Hash::make('password')
        ]);

        DB::table('users')->insert([
            'name' => 'Steve Jobs',
            'email' => 'stevejobs@apple.com',
            'password' => Hash::make('password')
        ]);

        DB::table('posts')->insert([
            'text' => 'Hi this is my app.',
            'userId' => 1
        ]);

        DB::table('posts')->insert([
            'text' => 'Focus is about saying no.',
            'userId' => 2
        ]);

        DB::table('posts')->insert([
            'text' => 'I wanna eat pizza.',
            'userId' => 2
        ]);

        DB::table('likes')->insert([
            'userId' => 1,
            'postId' => 1
        ]);

        DB::table('comments')->insert([
            'userId' => 1,
            'postId' => 1,
            'text' => 'Test comment'
        ]);
        DB::table('comments')->insert([
            'userId' => 2,
            'postId' => 2,
            'text' => 'Test comment'
        ]);

        DB::table('friendUsers')->insert([
            'userId' => 1,
            'friendId' => 2
        ]);

        DB::table('savedPosts')->insert([
            'userId' => 1,
            'postId' => 1
        ]);
    }
}
