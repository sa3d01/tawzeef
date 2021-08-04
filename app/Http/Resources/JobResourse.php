<?php

namespace App\Http\Resources;

use App\Models\Job;
use App\Models\JobSubscribe;
use App\Models\Major;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

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
        $arr['similar_majors']=new MajorCollection(Major::all());
        $arr['similar_jobs']=new JobCollection(Job::where('major_id',$this->major_id)->get());
        $arr['recommended_jobs']=new JobCollection(Job::where('major_id',$this->major_id)->get());
        $arr['start_date']=Carbon::parse($this->start_date)->format('Y-m-d');
        $arr['end_date']=Carbon::parse($this->end_date)->format('Y-m-d');
        $arr['show_company']=$this->show_company;
        $arr['my_job']=auth('api')->id()==$this->company->id;
        $arr['subscribed']=false;
//        $subscribes=[];
        if (auth('api')->check()){
            $subscribed=JobSubscribe::where([
                'user_id'=>auth('api')->id(),
                'job_id'=>$this->id,
            ])->first();
//            if (auth('api')->id()==$this->company->id){
//                foreach (JobSubscribe::where('job_id',$this->id)->latest()->get() as $subscribe)
//                {
//                    $subscribe_arr['user']=new SimpleUserResourse($subscribe->user);
//                    $subscribe_arr['cv']=new CvResource($subscribe->cv);
//                    $subscribe_arr['message']=$subscribe->message;
//                    $subscribe_arr['subscribed_from']=Carbon::parse($subscribe->created_at)->diffForHumans();
//                    $subscribes[]=$subscribe_arr;
//                }
//            }
            if ($subscribed){
                $arr['subscribed']=true;
            }
        }
//        $arr['subscribes']=$subscribes;
        return $arr;
    }
}
