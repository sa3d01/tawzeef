<?php

namespace App\Http\Controllers\Api\Visitor;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResourse;
use App\Http\Resources\MajorCollection;
use App\Http\Resources\SimpleCompanyResourse;
use App\Models\HiringAgent;
use App\Models\HiringLaw;
use App\Models\Job;
use App\Models\Major;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobController extends MasterController
{
    public function activeJobs(): object
    {
        $jobs_q = Job::where('status','!=','rejected');
        $jobs = $jobs_q->where('end_date', '>', Carbon::now())->paginate(10);
        return new JobCollection($jobs);
    }

    public function show($id): object
    {
        $job = Job::find($id);
        return $this->sendResponse(new JobResourse($job));
    }
    public function hiringAgents(): object
    {
        $agents=HiringAgent::whereStatus(true)->get();
        $result=[];
        foreach ($agents as $agent){
            $arr['id']=$agent->id;
            $arr['logo']=$agent->logo;
            $result[]=$arr;
        }
        return $this->sendResponse($result);
    }

    public function emailNewJob(Request $request):object
    {
        return $this->activeJobs();
    }

    public function activeCompanies():object
    {
//        $jobs_q = Job::where('status','!=','rejected');
//        $companies_id = $jobs_q->where('end_date', '>', Carbon::now())->pluck('company_id')->toArray();
        $companies=User::where('site_show',1)->get();
        return $this->sendResponse(SimpleCompanyResourse::collection($companies));
    }
    public function majors()
    {
        return $this->sendResponse(new MajorCollection(Major::where('parent_id',null)->get()));
    }
    public function majorJobs($id)
    {
        $jobs=Job::where('status','!=','rejected')->where('major_id',$id)->paginate(10);
        return new JobCollection($jobs);
    }
    public function hiringLaws()
    {
        $laws=HiringLaw::all();
        $result=[];
        foreach ($laws as $law){
            $title['ar']=$law->title_ar;
            $title['en']=$law->title_en;
            $note['ar']=$law->note_ar;
            $note['en']=$law->note_en;
            $arr['title']=$title;
            $arr['note']=$note;
            $arr['image']=$law->image;
            $result[]=$arr;
        }
        return $this->sendResponse($result);
    }

}
