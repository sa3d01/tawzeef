<?php

namespace App\Http\Resources;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobResourse extends JsonResource
{
    public function toArray($request): array
    {
        $arr['id'] = (int)$this->id;
        $arr['company'] = new SimpleCompanyResourse($this->company);
        $arr['major'] = new MajorResourse($this->major);
        $arr['job_title'] = $this->job_title;
        $arr['country']=new CountryResourse($this->country);
        $arr['city']=new CityResourse($this->city);
        $arr['working_type']=$this->working_type;
        $arr['qualification_type']=$this->qualification_type;
        $arr['level']=$this->level;
        $arr['experience_years']=$this->experience_years;
        $arr['expected_salary']=$this->expected_salary;
        $arr['description']=$this->description;
        $arr['sex']=$this->sex??"";
        $arr['location']=$this->location;
        $arr['published_at']=Carbon::parse($this->start_date)->diffForHumans();
        return $arr;
    }
}
