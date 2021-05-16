<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\JobStoreRequest;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResourse;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobController extends MasterController
{
    public function activeJobs(): object
    {
        $jobs_q=Job::query();
        if (request()->input('major_id')){
            $jobs_q=$jobs_q->where('job_id',request()->input('job_id'));
        }
        $jobs= $jobs_q->where('end_date','>',Carbon::now())->paginate(10);
        return new JobCollection($jobs);
//        $jobs = $jobs_q->get()->filter(function ($job) {
//            $startTime = Carbon::parse($job->start_date)->format('Y-M-d');
//            $endTime = Carbon::parse($job->end_date)->format('Y-M-d');
//            if (Carbon::now()->between($startTime, $endTime)) {
//                return $job;
//            }
//        });
//        return $this->sendResponse(new JobCollection($jobs));
    }

    public function expiredJobs()
    {
        $jobs= Job::where('end_date','<',Carbon::now())->paginate(10);
        return new JobCollection($jobs);
//        $jobs_q=Job::query();
//        if (request()->input('major_id')){
//            $jobs_q=$jobs_q->where('job_id',request()->input('job_id'));
//        }
//        $jobs = $jobs_q->get()->filter(function ($job) {
//            if (Carbon::now() > $job->end_date) {
//                return $job;
//            }
//        });
//        return $this->sendResponse(new JobCollection($jobs));
    }

    public function show($id): object
    {
        $job = Job::find($id);

        return $this->sendResponse(new JobResourse($job));
    }
    public function store(JobStoreRequest $request): object
    {
        $data = $request->validated();
        $data['company_id'] = auth('api')->id();
        $job = Job::create($data);
        return $this->sendResponse(new JobResourse($job));
    }

}
