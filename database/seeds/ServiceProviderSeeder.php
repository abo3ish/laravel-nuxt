<?php

use App\Models\Area;
use App\Models\ServiceProvider;
use Illuminate\Database\Seeder;
use App\Models\ServiceProviderType;

class ServiceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceProvider::create([
            'name' => 'kashwedawaa pharmacy',
            'type_id' => ServiceProviderType::all()->random()->id,
            'national_id' => '29400232',
            'phone' => '01018304360',
            'area_id' => Area::all()->random()->id,
            'address' => 'El bahr st, Tanta',
            'password' => bcrypt('secret'),
            // 'status' => 1,
            'last_seen' => now()
        ]);
    }
}
