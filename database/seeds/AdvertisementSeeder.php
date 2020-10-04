<?php

use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*****************************
            Splash Ads
         *****************************/
        Advertisement::create([
            'image' => 'splashAd1.jpg',
            'slug' => 'splash',
            'position' => 'full'
        ]);

        /*****************************
            Home Ads
         *****************************/
        Advertisement::create([
            'image' => 'homeAd1.jpg',
            'slug' => 'home',
            'position' => 'top'
        ]);
        Advertisement::create([
            'image' => 'homeAd2.png',
            'slug' => 'home',
            'position' => 'top'

        ]);
        Advertisement::create([
            'image' => 'homeAd3.png',
            'slug' => 'home',
            'position' => 'top'

        ]);


        /*****************************
            Examination Ads
         *****************************/
        Advertisement::create([
            'image' => 'examinationAd1.png',
            'slug' => 'examination',
            'position' => 'top'

        ]);
        Advertisement::create([
            'image' => 'examinationAd2.png',
            'slug' => 'examination',
            'position' => 'top'

        ]);
        Advertisement::create([
            'image' => 'examinationAd3.png',
            'slug' => 'examination',
            'position' => 'top'

        ]);


        /*****************************
            Doctor Ads
         *****************************/
        Advertisement::create([
            'image' => 'doctorAd1.png',
            'slug' => 'doctor',
            'position' => 'bottom'

        ]);
        Advertisement::create([
            'image' => 'doctorAd2.png',
            'slug' => 'doctor',
            'position' => 'bottom'

        ]);
        Advertisement::create([
            'image' => 'doctorAd3.png',
            'slug' => 'doctor',
            'position' => 'bottom'

        ]);


        /*****************************
            Laboratory Ads
         *****************************/
        Advertisement::create([
            'image' => 'laboratoryAd1.png',
            'slug' => 'laboratory',
            'position' => 'bottom'

        ]);
        Advertisement::create([
            'image' => 'laboratoryAd2.png',
            'slug' => 'laboratory',
            'position' => 'bottom'

        ]);
        Advertisement::create([
            'image' => 'laboratoryAd3.png',
            'slug' => 'laboratory',
            'position' => 'bottom'

        ]);


        /*****************************
            Pharmacy Categories
         *****************************/
        Advertisement::create([
            'image' => 'pharmacyCategoryAd1.png',
            'slug' => 'pharmacy-category',
            'position' => 'top'

        ]);
        Advertisement::create([
            'image' => 'pharmacyCategoryAd2.png',
            'slug' => 'pharmacy-category',
            'position' => 'top'

        ]);
        Advertisement::create([
            'image' => 'pharmacyCategoryAd3.png',
            'slug' => 'pharmacy-category',
            'position' => 'top'

        ]);

        /*****************************
            Pharmacy Drugs
         *****************************/
        Advertisement::create([
            'image' => 'drugAd1.png',
            'slug' => 'drugs',
            'position' => 'bottom'

        ]);
        Advertisement::create([
            'image' => 'drugAd2.png',
            'slug' => 'drugs',
            'position' => 'bottom'

        ]);
        Advertisement::create([
            'image' => 'drugAd3.png',
            'slug' => 'drugs',
            'position' => 'bottom'

        ]);
    }
}
