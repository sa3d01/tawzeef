<?php

namespace Database\Seeders;

use App\Models\Bank;
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
            'email'=>'info@zad-map.com',
        ]);
        Socials::create([
            'facebook'=>'https://facebook.com/',
            'twitter'=>'https://twitter.com/',
            'insta'=>'https://instagram.com/'
        ]);
    }
}
