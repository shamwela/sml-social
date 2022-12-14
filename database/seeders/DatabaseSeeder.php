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

        DB::table('users')->insert([
            'name' => 'Bill Gates',
            'email' => 'billgates@microsoft.com',
            'password' => Hash::make('password')
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'text' => 'Hi this is my app.'
        ]);

        DB::table('posts')->insert([
            'user_id' => 2,
            'text' => 'Hi. My name is Steve Jobs.'
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

        DB::table('saved_posts')->insert([
            'user_id' => 1,
            'post_id' => 1
        ]);
    }
}
