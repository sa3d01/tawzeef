<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['id'] = (int)$obj->id;
            $arr['company'] = new SimpleCompanyResourse($obj->company);
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
            $data[] = $arr;
        }
        return $data;
    }
}
