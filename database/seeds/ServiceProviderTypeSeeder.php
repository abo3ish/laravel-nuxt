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
            'title' => 'طبيب أطفال',
            'slug' => 'pediatrician',
        ]);
        ServiceProviderType::create([
            'title' => 'طبيب باطنة',
            'slug' => 'internist',
        ]);
        ServiceProviderType::create([
            'title' => 'طبيب عام ',
            'slug' => 'general_doctor',
        ]);
        ServiceProviderType::create([
            'title' => 'طبيب عظام ',
            'slug' => 'orthopedics'
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
