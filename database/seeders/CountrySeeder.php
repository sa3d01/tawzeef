<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name_ar'=>'مصر',
            'name_en'=>'egypt',
            'currency_label'=>'eg',
        ]);
        Country::create([
            'name_ar'=>'المملكة العربية السعودية',
            'name_en'=>'sudia arabia',
            'currency_label'=>'sa',
        ]);

    }
}
