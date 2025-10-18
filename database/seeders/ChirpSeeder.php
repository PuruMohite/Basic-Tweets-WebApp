<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create a few sample users if they don't exist
        $users = User::count() < 3 ? [
            User::create([
                'name' => 'Alice Developer',
                'email' => 'alice@example.com',
                'password' => bcrypt('password'),
            ]),
            User::create([
                'name' => 'Bob Builder',
                'email' => 'bob@example.com',
                'password' => bcrypt('password'),
            ]),
            User::create([
                'name' => 'Charlie Coder',
                'email' => 'charlie@example.com',
                'password' => bcrypt('password'),
            ]),
        ] : User::take(3)->get();

        $chirps = [
            'Just Discovered Laravel - where has this been all my life?',
            'Building something cool with Chirper today!',
            'Laravel\'s Eloquen ORM is pure magic ✨',
            'We can deploy Laravel Apps with Laravel Cloud smoothly!',
            'Who else is loving Blade components?',
            'Friday deploys with Laravel? No problem! 😎'
        ];
        
        foreach($chirps as $message){
            $users->random()->chirps()->create([
                'message' => $message,
                'created_at' => now()->subMinutes(rand(5,1440)),
            ]);
        }
    }
}
