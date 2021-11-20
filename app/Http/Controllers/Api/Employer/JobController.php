<?php

namespace App\Http\Controllers\Api\Employer;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResourse;
use App\Http\Resources\SimpleUserResourse;
use App\Models\AlertJob;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobRequired;
use App\Models\JobSubscribe;
use App\Models\Notification;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends MasterController
{
    public function activeJobs(): object
    {
        $user = auth('api')->user();
        $jobs_q = Job::where('status','!=','rejected');
//        $jobs_q = $jobs_q->where('major_id', $user->major_id);

        $companies=$jobs_q->pluck('company_id')->toArray();
        $active_companies=User::whereIn('id',$companies)->whereBanned(0)->pluck('id')->toArray();

        $jobs = $jobs_q->whereIn('company_id',$active_companies)->where('end_date', '>', Carbon::now())->paginate(10);
        return new JobCollection($jobs);
    }
    public function expiredJobs(): object
    {
        $user = auth('api')->user();
        $jobs_q = Job::where('status','!=','rejected');
      //  $jobs_q = $jobs_q->where('major_id', $user->major_id);

        $companies=$jobs_q->pluck('company_id')->toArray();
        $active_companies=User::whereIn('id',$companies)->whereBanned(0)->pluck('id')->toArray();

        $jobs = $jobs_q->whereIn('company_id',$active_companies)->where('end_date', '<', Carbon::now())->paginate(10);
        return new JobCollection($jobs);
    }

    public function show($id): object
    {
        $job = Job::find($id);
        return $this->sendResponse(new JobResourse($job));
    }

    public function notifyNewJob(Request $request):object
    {
        AlertJob::create([
            'user_id'=>auth('api')->id(),
            'country_id'=>$request['country_id'],
            'city_id'=>$request['city_id'],
            'notify'=>$request['notify'],
            'hashtags'=>$request['hashtags'],
        ]);
        return $this->activeJobs();
    }

    public function findJob(Request $request)
    {
        $job_q = Job::where('status','!=','rejected');
        if ($request['job_title']) {
            $job_q = $job_q->where('job_title', 'LIKE', "%{$request['job_title']}%");
        }
        if ($request['majors']) {
            $majors=explode(',',$request['majors']);
            $job_q = $job_q->whereIn('major_id', $majors);
        }
        if ($request['countries']) {
            $countries=explode(',',$request['countries']);
            $job_q = $job_q->whereIn('country_id', $countries);
        }
        if ($request['cities']) {
            $cities=explode(',',$request['cities']);
            $job_q = $job_q->whereIn('city_id', $cities);
        }
        if ($request['working_types']) {
            $working_types=explode(',',$request['working_types']);
            $job_q = $job_q->whereIn('working_type', $working_types);
        }
        if ($request['levels']) {
            $levels=explode(',',$request['levels']);
            $job_q = $job_q->whereIn('level', $levels);
        }
        if ($request['sex']) {
            $job_q = $job_q->where('sex', $request['sex']);
        }
        if ($request['expected_salary']) {
            $job_q = $job_q->where('expected_salary', $request['salary_from']);
        }
        if ($request['experience_years']) {
            $job_q = $job_q->where('experience_years', $request['experience_years']);
        }
        $companies=$job_q->pluck('company_id')->toArray();
        $active_companies=User::whereIn('id',$companies)->whereBanned(0)->pluck('id')->toArray();

        $jobs = $job_q->whereIn('company_id',$active_companies)->latest()->get();
        return $this->sendResponse(new JobCollection($jobs));
    }
    public function subscribeJob(Request $request)
    {
        $job=Job::find($request['job_id']);
        if ($job->end_date < Carbon::now()){
            return $this->sendError('هذه الوظيفه انتهي الوقت المحدد لها','end_date');
        }
        $data=[
            'user_id'=>auth('api')->id(),
            'job_id'=>$request['job_id'],
            'cv_id'=>$request['cv_id'],
            'message'=>$request['message']
        ];
        $subscribed=JobSubscribe::where($data)->first();
        if ($subscribed){
            return $this->sendError('some thing error');
        }
        $subscribed=JobSubscribe::create($data);
        Notification::create([
            'receiver_id'=>$job->company_id,
            'model'=>'JobSubscribe',
            'model_id'=>$job->id,
            'note_ar'=>'لديك متقدم لوظيفة جديد من '.auth('api')->user()->profile->first_name,
            'note_en'=>' you have new form subscribe from '.auth('api')->user()->profile->first_name
        ]);
        return $this->sendResponse(new JobResourse(Job::find($request['job_id'])));
    }

}
