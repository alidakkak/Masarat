<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    \App\Models\User::factory(10)->create();
//        \App\Models\Conversation::factory(10)->create();
//        \App\Models\Message::factory(40)->create();
//        \App\Models\Member::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0937356470',
            'password' => '11111111',
            "type"=>"admin",
        ]);
    }
}
