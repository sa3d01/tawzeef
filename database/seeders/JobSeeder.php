<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Job;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company_1=User::find(1);
        Job::create([
           'company_id'=>$company_1->id,
            'job_title'=>'backend developer',
            'major_id'=>2,
            'level'=>'high',
            'qualification_type'=>'bachelor',
            'sex'=>'male',
            'start_date'=>Carbon::now()->subDay(),
            'end_date'=>Carbon::now()->addDays(30),
            'expected_salary'=>100000,
            'experience_years'=>6,
            'country_id'=>1,
            'city_id'=>1,
            'location->lat'=>'31.0365933',
            'location->lng'=>'31.3950696',
            'working_type'=>'remotely',
            'description'=>'*LLC d/b/aCalifornia, LLC in FL, GA, MT, and NY. All loans are issued by either Celtic Bank or Square Financial Services, Inc. Square Financial Services, Inc. and Celtic Bank are both Utah-Chartered Industrial Banks. Members FDIC, located in Salt Lake City, UT. The bank issuing your loan will be identified in your loan agreement. All loans are subject to credit approval.',
            'invoice_image'=>'IxrWG8Zsec.pdf',
            'status'=>'approved'
        ]);
        $company_2=User::find(2);
        Job::create([
            'company_id'=>$company_2->id,
            'job_title'=>'business developer',
            'major_id'=>1,
            'level'=>'average',
            'qualification_type'=>'secondary',
            'sex'=>'female',
            'start_date'=>Carbon::now()->subDay(),
            'end_date'=>Carbon::now()->addDays(30),
            'expected_salary'=>1500,
            'experience_years'=>1,
            'country_id'=>2,
            'city_id'=>2,
            'location->lat'=>'24.7255553',
            'location->lng'=>'47.1027142',
            'working_type'=>'full_time',
            'description'=>'* LLC and Square Financial Services, Inc. are both wholly owned subsidiaries of Square, Inc. Square Capital, LLC d/b/a Square Capital of California, LLC in FL, GA, MT, and NY. All loans are issued by either Celtic Bank or Square Financial Services, Inc. Square Financial Services, Inc. and Celtic Bank are both Utah-Chartered Industrial Banks. Members FDIC, located in Salt Lake City, UT. The bank issuing your loan will be identified in your loan agreement. All loans are subject to credit approval.',
            'invoice_image'=>'IxrWG8Zsec.pdf',
            'status'=>'approved'
        ]);
        $company_3=User::find(3);
        Job::create([
            'company_id'=>$company_3->id,
            'job_title'=>'civil engineer',
            'major_id'=>3,
            'level'=>'fresh_graduate',
            'qualification_type'=>'bachelor',
            'sex'=>'male',
            'start_date'=>Carbon::now()->subDay(),
            'end_date'=>Carbon::now()->addDays(30),
            'expected_salary'=>5000,
            'experience_years'=>2,
            'country_id'=>1,
            'city_id'=>1,
            'location->lat'=>'24.7255553',
            'location->lng'=>'47.1027142',
            'working_type'=>'full_time',
            'description'=>'الذي صمد أمام اختبار الزمن.

تقدم مشروعات "معمار المرشدي" مفهومًا جديدًا للمعيشة يوفر مشاريع تنموية متكاملة تجمع بين المباني السكنية والإدارية والتجارية في مكان واحد لمساعدة عملائنا على الاستمتاع بحياة أكثر راحة.

تتأهب شركة "معمار المرشدي" للنجاحات التي حققتها من خلال مجموعة واسعة من المشاريع العقارية التي تتراوح بين المساكن الإقتصادية والإسكان من الطبقة المتوسطة وحتى المساكن الفخمة في جميع أنحاء القاهرة والجيزة.

مهمتنا
تصميم وبناء وإدارة مشاريع سكنية وتجارية وإدارية ورياضية وترفيهية راقية وذات رؤية طويلة المدى لكل من عملائنا وشركائنا في العمل ومجتمعنا، مع إلتزامنا بالنزاهة والأمانة والحرفية والإبداع والج

رؤيتنا
تقديم معمار عصري ذو ملامح جمالية فريدة بتصميمات مبتكرة وراقية تترك أثرها الجمالي والإيجابي علي مجتمعنا، مع الإستثمار الدائم للفكر والإبداع للتوسع في السوق الإقليمية.

القيم
إن نجاح معمار المرشدى تحكمه مبادئنا الأساسية التالية :
. All loans are subject to credit approval.',
            'invoice_image'=>'IxrWG8Zsec.pdf',
            'status'=>'approved'
        ]);

    }
}
