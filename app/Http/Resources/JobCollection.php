<?php

namespace App\Http\Resources;

use App\Models\Job;
use App\Models\JobSubscribe;
use App\Models\Major;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use phpDocumentor\Reflection\Types\Object_;

class JobCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['id'] = (int)$obj->id;
            $arr['company'] = new SimpleCompanyResourse($obj->company);
            $arr['show_company']=$obj->show_company;

//            if ($obj->show_company==0)
//            {
//                $arr['company']=new Object_();
//            }
            $arr['major'] = new MajorResourse($obj->major);
            $arr['job_title'] = $obj->job_title;
            $arr['country']=new CountryResourse($obj->country);
            $arr['city']=new CityResourse($obj->city);
            $arr['working_type']=$obj->working_type;
            $arr['qualification_type']=$obj->qualification_type;
            $arr['level']=$obj->level;
            $arr['experience_years']=$obj->experience_years;
            $arr['expected_salary']=$obj->expected_salary;
            $arr['description']=$obj->description;
            $arr['sex']=$obj->sex??"";
            $arr['location']=$obj->location;
            $arr['published_at']=Carbon::parse($obj->start_date)->diffForHumans();
            $arr['my_job']=auth('api')->id()==$obj->company->id;
            $arr['similar_majors']=new MajorCollection(Major::whereBanned(0)->get());
            $arr['subscribed']=false;
            $arr['my_job']=false;
            if (auth('api')->check()){
                $arr['my_job']=auth('api')->id()==$obj->company->id;
                $subscribed=JobSubscribe::where([
                    'user_id'=>auth('api')->id(),
                    'job_id'=>$obj->id,
                ])->first();
                if ($subscribed){
                    $arr['subscribed']=true;
                }
            }
            $arr['employees_count']=JobSubscribe::where('job_id', $obj->id)->count();
            $data[] = $arr;
        }
        return $data;
    }
}
