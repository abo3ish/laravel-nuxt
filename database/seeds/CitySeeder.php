<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name' => 'القاهرة',
            'status' => 1
        ]);
        City::create([
            'name' => 'الجيزة',
            'status' => 1
        ]);
        City::create([
            'name' => 'مدينة نصر',
            'status' => 1
        ]);
        City::create([
            'name' => 'المعادي',
            'status' => 1
        ]);
        City::create([
            'name' => 'طنطا',
            'status' => 1
        ]);
    }
}
