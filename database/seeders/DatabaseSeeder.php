<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        /*
        DB::table('host')->insert([
             'username' => 'host',
             'password' => Hash::make('host'),
             'phonenumber' => '012302302',
             'email' => 'host@gmail.com'
        ]); */
        DB::table('user')->insert([
            'username' => 'user1',
            'password' => Hash::make('user1'),
            'email' => 'user@gmail.com'
       ]);
    }
}
