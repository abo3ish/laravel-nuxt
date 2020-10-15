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
            'phone' => '01018304360',
            'area_id' => Area::all()->random()->id,
            'address' => 'El bahr st, Tanta',
            'email' => 'serviceProvider@gmail.com',
            'password' => bcrypt('secret'),
            'status' => 1,
            'age' => 26,
            'last_seen' => now()
        ]);
    }
}
