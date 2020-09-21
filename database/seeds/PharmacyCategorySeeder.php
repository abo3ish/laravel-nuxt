<?php

use App\Models\PharmacyCategory;
use Illuminate\Database\Seeder;

class PharmacyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drugs = PharmacyCategory::create([
            'title' => 'الادوية',
            'description' => '',
            'icon' => 'drugs-jar.png',
            'slug' => 'drugs'
        ]);

        /*
            ************** Kids ****************
        */
        $kids = PharmacyCategory::create([
            'title' => 'الالبان ومستلزمات االاطفال',
            'description' => '',
            'icon' => 'motherWhite.png',
            'slug' => 'kids'
        ]);
        PharmacyCategory::create([
            'title' => 'البان واغذية اطفال',
            'description' => '',
            'icon' => 'pacifier.png',
            'slug' => '',
            'parent_id' => $kids->id
        ]);
        PharmacyCategory::create([
            'title' => 'حفاضات الطفال',
            'description' => '',
            'icon' => 'newborn.png',
            'slug' => '',
            'parent_id' => $kids->id
        ]);
        PharmacyCategory::create([
            'title' => 'مستلزمات رضاعة',
            'description' => '',
            'icon' => 'baby-products.png',
            'slug' => '',
            'parent_id' => $kids->id
        ]);
        PharmacyCategory::create([
            'title' => 'المنظفات والعناية بالطفل',
            'description' => '',
            'icon' => 'maternity.png',
            'slug' => '',
            'parent_id' => $kids->id
        ]);

        /*
            ************** Beauty ****************
        */
        $beauty = PharmacyCategory::create([
            'title' => 'التجميل والعناية الشخصية',
            'description' => '',
            'icon' => 'beauty.png',
            'slug' => 'beauty'
        ]);
        PharmacyCategory::create([
            'title' => 'صحة وجمال والمرأة',
            'description' => '',
            'icon' => 'make-upWhite.png',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);
        PharmacyCategory::create([
            'title' => 'مستلزمات الرجال',
            'description' => '',
            'icon' => 'man.png',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);
        PharmacyCategory::create([
            'title' => 'مسلتزمات الاستحمام',
            'description' => '',
            'icon' => 'gel.png',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);
        PharmacyCategory::create([
            'title' => 'العناية بالفم',
            'description' => '',
            'icon' => 'toothbrush.png',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);
        PharmacyCategory::create([
            'title' => 'الصحة الجنسية',
            'description' => '',
            'icon' => 'sexual-transmitted-disease.png',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);

        /*
            ************** Women ****************
        */
        $women = PharmacyCategory::create([
            'title' => 'صحة وجمال المرأة',
            'description' => '',
            'icon' => 'make-upWhite.png',
            'slug' => 'women'
        ]);
        PharmacyCategory::create([
            'title' => 'الفوط والعناية النسائية',
            'description' => '',
            'icon' => 'sanitary-towel.png',
            'slug' => '',
            'parent_id' => $women->id
        ]);
        PharmacyCategory::create([
            'title' => 'مستحضرات التجميل',
            'description' => '',
            'icon' => 'cosmetics.png',
            'slug' => '',
            'parent_id' => $women->id
        ]);
        PharmacyCategory::create([
            'title' => 'منتجات التجميل الطبية',
            'description' => '',
            'icon' => 'skincare.png',
            'slug' => '',
            'parent_id' => $women->id
        ]);
        PharmacyCategory::create([
            'title' => 'العناية بالبشرة',
            'description' => '',
            'icon' => 'skin.png',
            'slug' => '',
            'parent_id' => $women->id
        ]);
        PharmacyCategory::create([
            'title' => 'العدسات اللاصقة',
            'description' => '',
            'icon' => 'lenses.png',
            'slug' => '',
            'parent_id' => $women->id
        ]);

        /*
            ************** Supplies ****************
        */
        $supplies = PharmacyCategory::create([
            'title' => 'أجهزة ومستلزمات طبية',
            'description' => '(قطن-شاش-سرنجات-كانيولا-اجهزة طبية...)',
            'icon' => 'medicalTools.png',
            'slug' => 'supplies'
        ]);

        $gym = PharmacyCategory::create([
            'title' => 'المكملات العذائية والجيم',
            'description' => '',
            'icon' => 'gym.png',
            'slug' => 'gym'
        ]);
    }
}
