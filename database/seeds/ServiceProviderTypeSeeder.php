<?php

use App\Models\ServiceProviderType;
use Illuminate\Database\Seeder;

class ServiceProviderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceProviderType::create([
            'title' => 'doctor',
        ]);
        ServiceProviderType::create([
            'title' => 'nurse',
        ]);
        ServiceProviderType::create([
            'title' => 'laboratory',
        ]);
        ServiceProviderType::create([
            'title' => 'radiologist',
        ]);
        ServiceProviderType::create([
            'title' => 'pharmacy',
        ]);
    }
}
