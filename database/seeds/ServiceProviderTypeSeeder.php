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
            'profit_percentage' => 20
        ]);
        ServiceProviderType::create([
            'title' => 'طبيب باطنة',
            'slug' => 'internist',
            'profit_percentage' => 20
        ]);
        ServiceProviderType::create([
            'title' => 'طبيب عام ',
            'slug' => 'general_doctor',
            'profit_percentage' => 20
        ]);
        ServiceProviderType::create([
            'title' => 'طبيب عظام ',
            'slug' => 'orthopedics',
            'profit_percentage' => 20
        ]);
        ServiceProviderType::create([
            'title' => 'تمريض',
            'slug' => 'nurse',
            'profit_percentage' => 30
        ]);
        ServiceProviderType::create([
            'title' => 'معمل تحاليل',
            'slug' => 'laboratory',
            'profit_percentage' => 20
        ]);
        ServiceProviderType::create([
            'title' => 'أخصائي أشعة',
            'slug' => 'radiologist',
            'profit_percentage' => 20
        ]);
        // ServiceProviderType::create([
        //     'title' => 'صيدلية',
        //     'slug' => 'pharmacy',
        //     'profit_percentage' => 7
        // ]);
        ServiceProviderType::create([
            'title' => 'ديليفري',
            'slug' => 'delivery',
            'profit_percentage' => 80
        ]);
    }
}
