<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'abo3ish',
            'email' => 'abo3ish@gmail.com',
            'phone' => '01018304360',
            'password' => bcrypt('abo3ish')
        ]);
    }
}
