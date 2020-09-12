<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'abo3ish',
            'email' => 'abo3ish@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('abo3ish'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'hussien',
            'email' => 'hussien@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('hussien'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'ezzat',
            'email' => 'ezzat@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('ezzat'),
            'remember_token' => Str::random(10),
        ]);
    }
}
