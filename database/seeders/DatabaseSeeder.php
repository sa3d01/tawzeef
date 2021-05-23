<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class,
//            CountrySeeder::class,
//            CitySeeder::class,
//            MajorSeeder::class,
//            CompanySeeder::class,
//            EmployerSeeder::class,
//            JobSeeder::class
        ]);
    }
}
