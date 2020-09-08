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
            'icon' => '',
            'slug' => 'drugs'
        ]);

        /*
            ************** Kids ****************
        */
        $kids = PharmacyCategory::create([
            'title' => 'الالبان ومستلزمات االاطفال',
            'description' => '',
            'icon' => '',
            'slug' => 'kids'
        ]);
        PharmacyCategory::create([
            'title' => 'البان واغذية اطفال',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $kids->id
        ]);
        PharmacyCategory::create([
            'title' => 'حفاضات الطفال',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $kids->id
        ]);
        PharmacyCategory::create([
            'title' => 'مستلزمات رضاعة',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $kids->id
        ]);
        PharmacyCategory::create([
            'title' => 'المنظفات والعناية بالطفل',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $kids->id
        ]);

        /*
            ************** Beauty ****************
        */
        $beauty = PharmacyCategory::create([
            'title' => 'التجميل والعناية الشخصية',
            'description' => '',
            'icon' => '',
            'slug' => 'beauty'
        ]);
        PharmacyCategory::create([
            'title' => 'صحة وجمال والمرأة',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);
        PharmacyCategory::create([
            'title' => 'مستلزمات الرجال',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);
        PharmacyCategory::create([
            'title' => 'مسلتزمات الاستحمام',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);
        PharmacyCategory::create([
            'title' => 'العناية بالفم',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);
        PharmacyCategory::create([
            'title' => 'الصحة الجنسية',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $beauty->id
        ]);

        /*
            ************** Women ****************
        */
        $women = PharmacyCategory::create([
            'title' => 'صحة وجمال المرأة',
            'description' => '',
            'icon' => '',
            'slug' => 'women'
        ]);
        PharmacyCategory::create([
            'title' => 'الفوط والعناية النسائية',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $women->id
        ]);
        PharmacyCategory::create([
            'title' => 'مستحضرات التجميل',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $women->id
        ]);
        PharmacyCategory::create([
            'title' => 'منتجات التجميل الطبية',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $women->id
        ]);
        PharmacyCategory::create([
            'title' => 'العناية بالبشرة',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $women->id
        ]);
        PharmacyCategory::create([
            'title' => 'العدسات اللاصقة',
            'description' => '',
            'icon' => '',
            'slug' => '',
            'parent_id' => $women->id
        ]);

        /*
            ************** Supplies ****************
        */
        $supplies = PharmacyCategory::create([
            'title' => 'أجهزة ومستلزمات طبية',
            'description' => '(قطن-شاش-سرنجات-كانيولا-اجهزة طبية...)',
            'icon' => '',
            'slug' => 'supplies'
        ]);

        $gym = PharmacyCategory::create([
            'title' => 'المكملات العذائية والجيم',
            'description' => '',
            'icon' => '',
            'slug' => 'gym'
        ]);
    }
}
