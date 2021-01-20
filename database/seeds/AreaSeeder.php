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
            'name' => 'مصر الجديدة',
            'governorate_id' => 1,
            'status' => 1
        ]);
        Area::create([
            'name' => 'مدينة نصر',
            'governorate_id' => 1,
            'status' => 1
        ]);
        Area::create([
            'name' => 'المعادي',
            'governorate_id' => 1,
            'status' => 1
        ]);
        Area::create([
            'name' => 'التجمع الخامس',
            'governorate_id' => 1,
            'status' => 1,
        ]);
        Area::create([
            'name' => 'حدائق القبة',
            'governorate_id' => 1,
            'status' => 1
        ]);
        Area::create([
            'name' => 'العبور',
            'governorate_id' => 1,
            'status' => 1
        ]);


        Area::create([
            'name' => 'قنا',
            'governorate_id' => 25,
            'status' => 1
        ]);
    }
}
