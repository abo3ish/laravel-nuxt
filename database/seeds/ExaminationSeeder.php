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
            'icon' => 'examinWhite.png',
            'slug' => 'doctor',
            'accept_multi' => false,
        ]);
        $generalDoctorServiceProvider = ServiceProviderType::where('slug', 'general_doctor')->first();
        $orthopedicsDoctorServiceProvider = ServiceProviderType::where('slug', 'orthopedics')->first();
        $internistDoctorServiceProvider = ServiceProviderType::where('slug', 'internist')->first();
        $pediatricianDoctorServiceProvider = ServiceProviderType::where('slug', 'pediatrician')->first();

        Service::create([
            'examination_id' => $homeExamination->id,
            'title' => 'طبيب عام',
            'icon' => 'doctor.png',
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
            'icon' => 'pediatrician.png',
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
            'icon' => 'heart.png',
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
            'icon' => 'bones.png',
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
            'icon' => 'nurseCapWhite.png',
            'slug' => 'nurse',
        ]);
        $nurseServiceProvider = ServiceProviderType::where('title', 'nurse')->first();

        $expressServices = Service::create([
            'examination_id' => $nursing->id,
            'title' => 'خدمات سريعة',
            'icon' => 'nurse.png',
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
            'icon' => 'blood-pressure-gauge.png',
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
            'icon' => 'canula.png',
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
            'icon' => 'syringe.png',
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
            'icon' => 'catheter.png',
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
            'icon' => 'plaster.png',
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
            'icon' => 'oxygen.png',
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
            'icon' => 'elder.png',
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
            'icon' => 'insurance.png',
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
        $physicalTherapy = Examination::create([
            'title' => ' علاج طبيعي',
            'description' => ' وصف للعنصر قد يمتد لسطرين او اكثر  وصف للعنصر قد يمتد لسطرين او اكثر ،',
            'icon' => 'physiotherapy.png'
        ]);


        /************************************
            Scan
         *************************************/

        $rays = Examination::create([
            'title' => 'أشعة بالمنزل',
            'description' => ' وصف للعنصر قد يمتد لسطرين او اكثر  وصف للعنصر قد يمتد لسطرين او اكثر ،',
            'icon' => 'skeletonWhite.png',
            'slug' => 'scan',
        ]);
        $radiologistServiceProvider = ServiceProviderType::where('title', 'radiologist')->first();

        Service::create([
            'examination_id' => $rays->id,
            'title' => 'x-rays',
            'icon' => 'skeleton.png',
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
            'icon' => 'sonar.png',
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
            'icon' => 'ecg.png',
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
            'icon' => 'eco.png',
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
            'icon' => 'microscopeWhite.png',
            'slug' => 'laboratory',
        ]);
        $laboratoryServiceProvider = ServiceProviderType::where('title', 'laboratory')->first();

        Service::create([
            'examination_id' => $tests->id,
            'title' => 'عينة دم',
            'icon' => 'blood-drop.png',
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
            'icon' => 'jar.png',
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
            'icon' => 'shit.png',
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
            'icon' => 'semen.png',
            'estimation_from' => 150,
            'estimation_to' => 300,
            'purchase_price' => 200,
            'sell_price' => 250,
            'slug' => 'sperm',
            'service_provider_type_id' => $laboratoryServiceProvider->id

        ]);

    }
}
