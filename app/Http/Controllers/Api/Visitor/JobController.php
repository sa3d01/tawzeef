<?php

namespace App\Http\Controllers\Api\Visitor;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResourse;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends MasterController
{
    public function activeJobs(): object
    {
        $jobs_q = Job::query();
        $jobs = $jobs_q->where('end_date', '>', Carbon::now())->paginate(10);
        return new JobCollection($jobs);
    }

    public function show($id): object
    {
        $job = Job::find($id);

        return $this->sendResponse(new JobResourse($job));
    }

    public function emailNewJob(Request $request):object
    {
        return $this->activeJobs();
    }

}
