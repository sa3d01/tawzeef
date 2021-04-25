<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Major::create([
            'name_ar'=>'ادارة أعمال',
            'name_en'=>'business',
        ]);
        Major::create([
            'name_ar'=>'برمجيات',
            'name_en'=>'programming',
        ]);
        Major::create([
            'name_ar'=>'محاسبة',
            'name_en'=>'commercial',
            'parent_id'=>1
        ]);
        Major::create([
            'name_ar'=>'تسويق',
            'name_en'=>'marketing',
            'parent_id'=>1
        ]);
        Major::create([
            'name_ar'=>'تصميم',
            'name_en'=>'design',
            'parent_id'=>2
        ]);
        Major::create([
            'name_ar'=>'برمجة تطبيقات',
            'name_en'=>'ios developer',
            'parent_id'=>2
        ]);


    }
}
