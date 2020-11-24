<?php

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'name' => 'القاهرة',
            'status' => 1
        ]);
        Area::create([
            'name' => 'الجيزة',
            'status' => 1
        ]);
        Area::create([
            'name' => 'مدينة نصر',
            'status' => 1
        ]);
        Area::create([
            'name' => 'المعادي',
            'status' => 1
        ]);
        Area::create([
            'name' => 'طنطا',
            'status' => 1
        ]);
        Area::create([
            'name' => 'قنا',
            'status' => 1
        ]);
    }
}
