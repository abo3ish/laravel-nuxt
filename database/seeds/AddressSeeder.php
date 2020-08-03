<?php

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Address::create([
           'user_id' => 1,
           'city_id' => 1,
           'street' => 'elshershaby',
           'building_number' => 1,
           'floor_number' => 1,
           'flat_number' => 1
       ]);
    }
}
