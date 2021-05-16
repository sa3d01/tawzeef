<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\ContactType;
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
        Page::create([
            'type'=>'terms',
            'for'=>'user',
            'title_ar'=>'الشروط والأحكام للموظف',
            'title_en'=>'terms',
            'note_ar'=>'الشروط والأحكام للمستخدم',
            'note_en'=>'terms',
        ]);
        Page::create([
            'type'=>'terms',
            'for'=>'company',
            'title_ar'=>'الشروط والأحكام للشركات',
            'title_en'=>'terms',
            'note_ar'=>'الشروط والأحكام للشركات',
            'note_en'=>'terms',
        ]);
        Page::create([
            'type'=>'about',
            'for'=>'all',
            'title_ar'=>'عن التطبيق',
            'title_en'=>'about',
            'note_ar'=>'نص عن التطبيق',
            'note_en'=>'about',
        ]);
        Page::create([
            'type'=>'bank',
            'for'=>'all',
            'title_ar'=>'نص عن الحسابات البنكية',
            'title_en'=>'about banks',
            'note_ar'=>'نص عن الحسابات البنكية',
            'note_en'=>'about banks',
        ]);
        Page::create([
            'type'=>'contact',
            'for'=>'all',
            'title_ar'=>'اتصل بنا',
            'title_en'=>'contact us',
            'note_ar'=>'نص تواصل معنا',
            'note_en'=>'contact us notes',
        ]);
        ContactType::create([
            'name_ar'=>'اقتراح',
            'name_en'=>'suggestion',
        ]);
        ContactType::create([
            'name_ar'=>'شكوي',
            'name_en'=>'report',
        ]);
        Bank::create([
            'name_ar'=>'البنك الأهلى',
            'name_en'=>'alahly',
            'account_number'=>'156863155368',
        ]);
        Bank::create([
            'name_ar'=>'البنك لراجحى',
            'name_en'=>'alraghy',
            'account_number'=>'156863155368',
        ]);
        Setting::create([
            'mobile'=>'+9665xxxxxxxx',
            'email'=>'info@tawzeef.com',
            'create_job'=>50
        ]);
        Socials::create([
            'facebook'=>'https://facebook.com/',
            'twitter'=>'https://twitter.com/',
            'insta'=>'https://instagram.com/'
        ]);
    }
}
