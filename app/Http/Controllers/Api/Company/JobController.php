<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\JobStoreRequest;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResourse;
use App\Models\Job;
use Carbon\Carbon;

class JobController extends MasterController
{
    public function activeJobs(): object
    {
        $jobs = Job::all()->filter(function ($job) {
            $startTime = Carbon::parse($job->start_date)->format('Y-M-d');
            $endTime = Carbon::parse($job->end_date)->format('Y-M-d');
            if (Carbon::now()->between($startTime, $endTime)) {
                return $job;
            }
        });
        return $this->sendResponse(new JobCollection($jobs));
    }

    public function expiredJobs(): object
    {
        $jobs = Job::all()->filter(function ($job) {
            $endTime = Carbon::parse($job->end_date)->format('Y-M-d');
            if (Carbon::now() > $endTime) {
                return $job;
            }
        });
        return $this->sendResponse(new JobCollection($jobs));
    }

    public function store(JobStoreRequest $request): object
    {
        $data = $request->validated();
        $data['company_id'] = auth('api')->id();
        $job = Job::create($data);
        return $this->sendResponse(new JobResourse($job));
    }

}
