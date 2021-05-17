<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employer_1=User::create([
            'type'=>'USER',
            'email'=>'saad@gmail.com',
            'phone'=>'01092291228',
            'email_verified_at'=>Carbon::now(),
            'country_id'=>1,
            'city_id'=>1,
            'major_id'=>2,
            'members_count'=>3,
            'password'=>'123456',
            'hear_by'=>'friend',
            'approved'=>true,
            'approved_at'=>Carbon::now()
        ]);
        Profile::create([
           'user_id'=>$employer_1->id,
            'first_name'=>'saad',
            'last_name'=>'salem',
            'sex'=>'male',
            'job_title'=>'backend developer',
            'birthdate'=>'01-06-1993',
            'social_status'=>'married',
            'drive_licence_nationality_id'=>1,
            'sub_majors'=>[6,7],
            'nationality_id'=>1,
        ]);
        $employer_2=User::create([
            'type'=>'USER',
            'email'=>'hesham@gmail.com',
            'phone'=>'01092291220',
            'email_verified_at'=>Carbon::now(),
            'country_id'=>2,
            'city_id'=>2,
            'major_id'=>1,
            'members_count'=>2,
            'password'=>'123456',
            'hear_by'=>'friend',
            'approved'=>true,
            'approved_at'=>Carbon::now()
        ]);
        Profile::create([
           'user_id'=>$employer_2->id,
            'first_name'=>'hesham',
            'last_name'=>'ashraf',
            'sex'=>'male',
            'job_title'=>'business developer',
            'birthdate'=>'01-06-1994',
            'social_status'=>'single',
            'drive_licence_nationality_id'=>1,
            'sub_majors'=>[5],
            'nationality_id'=>1,
        ]);
        $employer_2=User::create([
            'type'=>'USER',
            'email'=>'gemy@gmail.com',
            'phone'=>'01092291211',
            'email_verified_at'=>Carbon::now(),
            'country_id'=>1,
            'city_id'=>1,
            'major_id'=>3,
            'members_count'=>3,
            'password'=>'123456',
            'hear_by'=>'friend',
            'approved'=>true,
            'approved_at'=>Carbon::now()
        ]);
        Profile::create([
           'user_id'=>$employer_2->id,
            'first_name'=>'ahmed',
            'last_name'=>'gamal',
            'sex'=>'male',
            'job_title'=>'civil engineer',
            'birthdate'=>'01-06-1994',
            'social_status'=>'single',
            'drive_licence_nationality_id'=>1,
            'sub_majors'=>[8],
            'nationality_id'=>1,
        ]);

    }
}
