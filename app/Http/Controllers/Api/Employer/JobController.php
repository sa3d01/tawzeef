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
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends MasterController
{
    public function activeJobs(): object
    {
        $user = auth('api')->user();
        $jobs_q = Job::query();
        $jobs_q = $jobs_q->where('major_id', $user->major_id);
        $jobs = $jobs_q->where('end_date', '>', Carbon::now())->paginate(10);
        return new JobCollection($jobs);
    }
    public function expiredJobs(): object
    {
        $user = auth('api')->user();
        $jobs_q = Job::query();
        $jobs_q = $jobs_q->where('major_id', $user->major_id);
        $jobs = $jobs_q->where('end_date', '<', Carbon::now())->paginate(10);
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
        $job_q = Job::query();
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
        $jobs = $job_q->get();
        return $this->sendResponse(new JobCollection($jobs));
    }
    public function subscribeJob(Request $request)
    {
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
        JobSubscribe::create($data);
        return $this->sendResponse(new JobResourse(Job::find($request['job_id'])));
    }

}
