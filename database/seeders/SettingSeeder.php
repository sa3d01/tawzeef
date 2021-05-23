<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\ContactType;
use App\Models\HiringAgent;
use App\Models\HiringLaw;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Socials;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HiringLaw::create([
           'title_ar'=>'قانون العمل 1' ,
            'title_en'=>'hiring law 1',
           'note_ar'=>'نص قانون العمل 1' ,
            'note_en'=>'hiring law 1',
        ]);
        HiringLaw::create([
           'title_ar'=>'قانون العمل 2' ,
            'title_en'=>'hiring law 2',
           'note_ar'=>'نص قانون العمل 2' ,
            'note_en'=>'hiring law 2',
        ]);
        HiringLaw::create([
           'title_ar'=>'قانون العمل 3' ,
            'title_en'=>'hiring law 3',
           'note_ar'=>'نص قانون العمل 3' ,
            'note_en'=>'hiring law 3',
        ]);
//        for ($i=0;$i<6;$i++){
//            HiringAgent::create([
//                'logo'=>''
//            ]);
//        }

//        Page::create([
//            'type'=>'who_finding_jobs',
//            'for'=>'all',
//            'title_ar'=>'أشخاص وجدوا وظائف',
//            'title_en'=>'who finding jobs',
//            'note_ar'=>'مبدأ عمل التوظيف نص',
//            'note_en'=>'who finding jobs',
//        ]);
//
//        Page::create([
//            'type'=>'hiring_principles',
//            'for'=>'all',
//            'title_ar'=>'مبدأ عمل التوظيف',
//            'title_en'=>'hiring principle',
//            'note_ar'=>'مبدأ عمل التوظيف نص',
//            'note_en'=>'hiring principle data',
//        ]);
//
//        Page::create([
//            'type'=>'terms',
//            'for'=>'user',
//            'title_ar'=>'الشروط والأحكام للموظف',
//            'title_en'=>'terms',
//            'note_ar'=>'الشروط والأحكام للمستخدم',
//            'note_en'=>'terms',
//        ]);
//        Page::create([
//            'type'=>'terms',
//            'for'=>'company',
//            'title_ar'=>'الشروط والأحكام للشركات',
//            'title_en'=>'terms',
//            'note_ar'=>'الشروط والأحكام للشركات',
//            'note_en'=>'terms',
//        ]);
//        Page::create([
//            'type'=>'about',
//            'for'=>'all',
//            'title_ar'=>'عن التطبيق',
//            'title_en'=>'about',
//            'note_ar'=>'نص عن التطبيق',
//            'note_en'=>'about',
//        ]);
//        Page::create([
//            'type'=>'bank',
//            'for'=>'all',
//            'title_ar'=>'نص عن الحسابات البنكية',
//            'title_en'=>'about banks',
//            'note_ar'=>'نص عن الحسابات البنكية',
//            'note_en'=>'about banks',
//        ]);
//        Page::create([
//            'type'=>'contact',
//            'for'=>'all',
//            'title_ar'=>'اتصل بنا',
//            'title_en'=>'contact us',
//            'note_ar'=>'نص تواصل معنا',
//            'note_en'=>'contact us notes',
//        ]);
//        ContactType::create([
//            'name_ar'=>'اقتراح',
//            'name_en'=>'suggestion',
//        ]);
//        ContactType::create([
//            'name_ar'=>'شكوي',
//            'name_en'=>'report',
//        ]);
//        Bank::create([
//            'name_ar'=>'البنك الأهلى',
//            'name_en'=>'alahly',
//            'account_number'=>'156863155368',
//        ]);
//        Bank::create([
//            'name_ar'=>'البنك لراجحى',
//            'name_en'=>'alraghy',
//            'account_number'=>'156863155368',
//        ]);
//        Setting::create([
//            'mobile'=>'+9665xxxxxxxx',
//            'email'=>'info@tawzeef.com',
//            'create_job'=>50
//        ]);
//        Socials::create([
//            'facebook'=>'https://facebook.com/',
//            'twitter'=>'https://twitter.com/',
//            'insta'=>'https://instagram.com/'
//        ]);
    }
}
