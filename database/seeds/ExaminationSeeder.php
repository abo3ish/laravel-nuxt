<?php

use App\Models\Service;
use App\Models\Examination;
use App\Models\ServiceProviderType;
use Illuminate\Database\Seeder;

class ExaminationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /************************************
            Home Examination
         *************************************/
        $homeExamination = Examination::create([
            'title' => 'كشف منزلي',
            'description' => 'وصف للعنصر قد يمتد لسطرين او اكثر',
            'icon' => '',
            'slug' => 'doctor'
        ]);
        $generalDoctorServiceProvider = ServiceProviderType::where('slug', 'general_doctor')->first();
        $orthopedicsDoctorServiceProvider = ServiceProviderType::where('slug', 'orthopedics')->first();
        $internistDoctorServiceProvider = ServiceProviderType::where('slug', 'internist')->first();
        $pediatricianDoctorServiceProvider = ServiceProviderType::where('slug', 'pediatrician')->first();
        Service::create([
            'examination_id' => $homeExamination->id,
            'title' => 'طبيب عام',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'general_doctor',
            'service_provider_type_id' => $generalDoctorServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $homeExamination->id,
            'title' => 'طبيب أطفال',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'children_doctors',
            'service_provider_type_id' => $pediatricianDoctorServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $homeExamination->id,
            'title' => 'طبيب باطنة عام',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'internist',
            'service_provider_type_id' => $internistDoctorServiceProvider->id

        ]);
        Service::create([
            'examination_id' => $homeExamination->id,
            'title' => 'طبيب عظام',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'orthopedic_doctor',
            'service_provider_type_id' => $orthopedicsDoctorServiceProvider->id
        ]);

        /*************************************
            Nursing
         **************************************/
        $nursing = Examination::create([
            'title' => ' تمريض منزلي',
            'description' => 'وصف للعنصر قد يمتد لسطرين او اكثر',
            'icon' => '',
            'slug' => 'nurse',
        ]);
        $nurseServiceProvider = ServiceProviderType::where('title', 'nurse')->first();

        $expressServices = Service::create([
            'examination_id' => $nursing->id,
            'title' => 'خدمات سريعة',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'quick_services',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);


        Service::create([
            'examination_id' => $nursing->id,
            'title' => 'قياس ضغط/سكر',
            'icon' => '',
            'parent_id' => $expressServices->id,
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'diabetes',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $nursing->id,
            'title' => 'تركيب كانيولا/محلول',
            'icon' => '',
            'parent_id' => $expressServices->id,
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'lotion',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $nursing->id,
            'title' => 'حقن عضل',
            'icon' => '',
            'parent_id' => $expressServices->id,
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'injection',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);

        Service::create([
            'examination_id' => $nursing->id,
            'title' => 'قسطرة بولية ورايل للتغذية',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'catheter',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $nursing->id,
            'title' => 'العناية بالجروج',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'wounds',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $nursing->id,
            'title' => 'جلسة تنفس للأطفال والكبار',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'breathing_session',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $nursing->id,
            'title' => 'رعاية كبار سن 24 ساعة',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'elder_sitting',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $nursing->id,
            'title' => 'رعاية بعد العمليات',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'surgery_care',
            'service_provider_type_id' => $nurseServiceProvider->id
        ]);

        /************************************
            Physical Therapy
         *************************************/
        // $physicalTherapy = Examination::create([
        //     'title' => ' علاج طبيعي',
        //     'description' => ' وصف للعنصر قد يمتد لسطرين او اكثر  وصف للعنصر قد يمتد لسطرين او اكثر ،',
        //     'icon' => ''
        // ]);


        /************************************
            Scan
         *************************************/

        $rays = Examination::create([
            'title' => 'أشعة بالمنزل',
            'description' => ' وصف للعنصر قد يمتد لسطرين او اكثر  وصف للعنصر قد يمتد لسطرين او اكثر ،',
            'icon' => '',
            'slug' => 'scan',
        ]);
        $radiologistServiceProvider = ServiceProviderType::where('title', 'radiologist')->first();

        Service::create([
            'examination_id' => $rays->id,
            'title' => 'x-rays',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'x_rays',
            'service_provider_type_id' => $radiologistServiceProvider->id
        ]);
        Service::create([
            'examination_id' => $rays->id,
            'title' => 'سونار',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'sonar',
            'service_provider_type_id' => $radiologistServiceProvider->id

        ]);
        Service::create([
            'examination_id' => $rays->id,
            'title' => 'دوبلار',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'doppler',
            'service_provider_type_id' => $radiologistServiceProvider->id

        ]);
        Service::create([
            'examination_id' => $rays->id,
            'title' => 'رسم قلب',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'ekg',
            'service_provider_type_id' => $radiologistServiceProvider->id

        ]);
        Service::create([
            'examination_id' => $rays->id,
            'title' => 'ايكو',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'echo',
            'service_provider_type_id' => $radiologistServiceProvider->id

        ]);

        /************************************
            Laboratory services
         *************************************/
        $tests = Examination::create([
            'title' => ' تحاليل ',
            'description' => 'وصف للعنصر قد يمتد لسطرين او اكثر',
            'icon' => '',
            'slug' => 'laboratory',
        ]);
        $laboratoryServiceProvider = ServiceProviderType::where('title', 'laboratory')->first();

        Service::create([
            'examination_id' => $tests->id,
            'title' => 'عينة دم',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'blood',
            'service_provider_type_id' => $laboratoryServiceProvider->id

        ]);
        Service::create([
            'examination_id' => $tests->id,
            'title' => 'عينة بول',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'urin',
            'service_provider_type_id' => $laboratoryServiceProvider->id

        ]);
        Service::create([
            'examination_id' => $tests->id,
            'title' => 'عينة براز',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'sonar',
            'service_provider_type_id' => $laboratoryServiceProvider->id

        ]);
        Service::create([
            'examination_id' => $tests->id,
            'title' => 'عينة حيوانات منوية',
            'icon' => '',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'sperm',
            'service_provider_type_id' => $laboratoryServiceProvider->id

        ]);

    }
}
