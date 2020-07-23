<?php

use Illuminate\Database\Seeder;
use App\Models\ExaminationService;
use Illuminate\Support\Facades\DB;
use App\Models\ExaminationServiceType;

class ExaminationServiceSeeder extends Seeder
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
        $homeExamination = ExaminationService::create([
            'title' => 'كشف منزلي',
            'description' => 'وصف للعنصر قد يمتد لسطرين او اكثر',
            'icon' => '',
            'slug' => 'doctor'
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $homeExamination->id,
            'title' => 'طبيب عام',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $homeExamination->id,
            'title' => 'طبيب أطفال',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $homeExamination->id,
            'title' => 'طبيب باطنة عام',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $homeExamination->id,
            'title' => 'طبيب عظام',
            'icon' => ''
        ]);

        /*************************************
            Nursing
        **************************************/
        $nursing = ExaminationService::create([
            'title' => ' تمريض منزلي',
            'description' => 'وصف للعنصر قد يمتد لسطرين او اكثر',
            'icon' => '',
            'slug' => 'nurse',
        ]);
        $expressServices = ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'خدمات سريعة',
            'icon' => ''
        ]);

        ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'قياس ضغط/سكر',
            'icon' => '',
            'parent_id' => $expressServices->id
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'تركيب كانيولا/محلول',
            'icon' => '',
            'parent_id' => $expressServices->id
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'حقن عضل',
            'icon' => '',
            'parent_id' => $expressServices->id
        ]);

        ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'قسطرة بولية ورايل للتغذية',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'العناية بالجروج',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'جلسة تنفس للأطفال والكبار',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'رعاية كبار سن 24 ساعة',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $nursing->id,
            'title' => 'رعاية بعد العمليات',
            'icon' => ''
        ]);

        /************************************
            Physical Therapy
         *************************************/
        // $physicalTherapy = ExaminationService::create([
        //     'title' => ' علاج طبيعي',
        //     'description' => ' وصف للعنصر قد يمتد لسطرين او اكثر  وصف للعنصر قد يمتد لسطرين او اكثر ،',
        //     'icon' => ''
        // ]);


        /************************************
            Rays
         *************************************/
        $rays = ExaminationService::create([
            'title' => 'أشعة بالمنزل',
            'description' => ' وصف للعنصر قد يمتد لسطرين او اكثر  وصف للعنصر قد يمتد لسطرين او اكثر ،',
            'icon' => '',
            'slug' => 'ray'
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $rays->id,
            'title' => 'x-rays',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $rays->id,
            'title' => 'سونار',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $rays->id,
            'title' => 'دوبلار',
            'icon' => '',
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $rays->id,
            'title' => 'رسم قلب',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $rays->id,
            'title' => 'ايكو',
            'icon' => ''
        ]);

        /************************************
            Testing
         *************************************/
        $tests = ExaminationService::create([
            'title' => ' تحاليل ',
            'description' => 'وصف للعنصر قد يمتد لسطرين او اكثر',
            'icon' => '',
            'slug' => 'test'
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $tests->id,
            'title' => 'عينة دم',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $tests->id,
            'title' => 'عينة بول',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $tests->id,
            'title' => 'عينة براز',
            'icon' => ''
        ]);
        ExaminationServiceType::create([
            'examination_service_id' => $tests->id,
            'title' => 'عينة حيوانات منوية',
            'icon' => ''
        ]);
    }
}
