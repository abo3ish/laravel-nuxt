<?php

use App\Models\Area;
use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $govs = [
            /* القاهرة */
            [
                'name' => 'القاهرة',
                'areas' => [
                    'مصر الجديدة',
                    'مدينة نصر',
                    'المعادي',
                    'التجمع الخامس',
                    'حدائق القبة',
                    'العبور',
                ],
            ],
            /* الجيزة */
            [
                'name' => 'الجيزة',
                'areas' => [
                    'الدقي',
                    '6 اكتوبر',
                    'الهرم',
                    'فيصل',
                    'الشيخ زايد',
                    'حدائق الأهرام',
                ],
            ],
            /* الأسكندرية */
            [
                'name' => 'الأسكندرية',
                'areas' => []
            ],
            /* الدقهلية */
            [
                'name' => 'الدقهلية',
                'areas' => []
            ],
            /* البحيرة */
            [
                'name' => 'البحيرة',
                'areas' => []
            ],
            /* الفيوم */
            [
                'name' => 'الفيوم',
                'areas' => []
            ],
            /* الغربية */
            [
                'name' => 'الغربية',
                'areas' => [
                    'طنطا',
                    'السنطة'
                ],
            ],
            /* الإسماعلية */
            [
                'name' => 'الإسماعلية',
                'areas' => []
            ],
            /* المنوفية */
            [
                'name' => 'المنوفية',
                'areas' => []
            ],
            /* المنيا */
            [
                'name' => 'المنيا',
                'areas' => []
            ],
            /* القليوبية */
            [
                'name' => 'القليوبية',
                'areas' => []
            ],
            /* الوادي الجديد */
            [
                'name' => 'الوادي الجديد',
                'areas' => []
            ],
            /* السويس */
            [
                'name' => 'السويس',
                'areas' => []
            ],
            /* اسوان */
            [
                'name' => 'اسوان',
                'areas' => []
            ],
            /* اسيوط */
            [
                'name' => 'اسيوط',
                'areas' => []
            ],
            /* بني سويف */
            [
                'name' => 'بني سويف',
                'areas' => []
            ],
            /* بورسعيد */
            [
                'name' => 'بورسعيد',
                'areas' => []
            ],
            /* دمياط */
            [
                'name' => 'دمياط',
                'areas' => []
            ],
            /* الشرقية */
            [
                'name' => 'الشرقية',
                'areas' => []
            ],
            /* جنوب سيناء */
            [
                'name' => 'جنوب سيناء',
                'areas' => []
            ],
            /* كفر الشيخ */
            [
                'name' => 'كفر الشيخ',
                'areas' => []
            ],
            /* مطروح */
            [
                'name' =>  'مطروح',
                'areas' => []
            ],
            /* الأقصر */
            [
                'name' => 'الأقصر',
                'areas' => []
            ],
            /* قنا */
            [
                'name' => 'قنا',
                'areas' => [
                    'قنا'
                ],
            ],
            /* شمال سيناء */
            [
                'name' => 'شمال سيناء',
                'areas' => []
            ],
            /* سوهاج */
            [
                'name' => 'سوهاج',
                'areas' => []
            ],
        ];

        foreach ($govs as $gov) {
            $governorate = Governorate::create([
                'name' => $gov['name']
            ]);
            if (is_array($gov['areas'])) {
                foreach ($gov['areas'] as $area) {
                    Area::create([
                        'name' => $area,
                        'governorate_id' => $governorate->id,
                        'status' => 1
                    ]);
                }
            }
        }
    }
}
