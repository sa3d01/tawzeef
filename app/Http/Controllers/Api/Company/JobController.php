<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\JobStoreRequest;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResourse;
use App\Http\Resources\SimpleCompanyResourse;
use App\Http\Resources\SimpleJobResourse;
use App\Models\Job;
use App\Models\Major;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobController extends MasterController
{
    public function activeJobs(): object
    {
        $jobs_q=Job::where('company_id',auth('api')->id());
        if (request()->input('major_id')){
            $jobs_q=$jobs_q->where('job_id',request()->input('job_id'));
        }
        $jobs= $jobs_q->where('end_date','>',Carbon::now())->paginate(10);
        return new JobCollection($jobs);
    }

    public function expiredJobs()
    {
        $jobs= Job::where('company_id',auth('api')->id())->where('end_date','<',Carbon::now())->paginate(10);
        return new JobCollection($jobs);
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
    public function update($id,JobStoreRequest $request): object
    {
        $job = Job::find($id);
        if (!$job || ($job->company_id != auth('api')->id())){
            return $this->sendError('توجد مشكلة بالبيانات');
        }
        $job->update($request->validated());
        return $this->sendResponse(new JobResourse($job));
    }
    public function delete($id):object
    {
        $job = Job::find($id);
        if (!$job || ($job->company_id != auth('api')->id())){
            return $this->sendError('توجد مشكلة بالبيانات');
        }
        $job->delete();
        $jobs= Job::where('company_id',auth('api')->id())->paginate(10);
        return new JobCollection($jobs);
    }

    public function findJobSalary(Request $request)
    {
        $job_q = Job::query();
        if ($request['major_id']) {
            $job_q = $job_q->where('major_id', $request['major_id']);
        }
        if ($request['country_id']) {
            $job_q = $job_q->where('country_id', $request['country_id']);
        }
        if ($request['city_id']) {
            $job_q = $job_q->where('city_id', $request['city_id']);
        }
        $jobs=$job_q->pluck('expected_salary')->toArray();
        if (count($jobs)==0){
            return $this->sendResponse(0);
        }
        $average = array_sum($jobs) / count($jobs);
        return $this->sendResponse($average);
    }
    public function findAverageSalary(Request $request)
    {
        $jobs= Job::take(7)->get();
        $data=[];
        foreach ($jobs as $job){
            $arr['job'] = new SimpleJobResourse($job);
            $arr['expected_salary']=(int)$job->expected_salary;
            $data[]=$arr;
        }
        return $this->sendResponse($data);
    }

}
