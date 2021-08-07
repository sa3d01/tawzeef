<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\JobStoreRequest;
use App\Http\Resources\CvResource;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResourse;
use App\Http\Resources\SimpleJobResourse;
use App\Http\Resources\SimpleUserResourse;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobSubscribe;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

class JobController extends MasterController
{
    public function activeJobs(): object
    {
        $jobs_q = Job::where('company_id', auth('api')->id());
        if (request()->input('major_id')) {
            $jobs_q = $jobs_q->where('job_id', request()->input('job_id'));
        }
        $jobs = $jobs_q->where('end_date', '>', Carbon::now())->paginate(10);
        return new JobCollection($jobs);
    }

    public function expiredJobs()
    {
        $jobs = Job::where('company_id', auth('api')->id())->where('end_date', '<', Carbon::now())->paginate(10);
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
//        Notification::create([
//            'receiver_id'=>$id,
//            'model'=>'Message',
//            'model_id'=>$message->id,
//            'note_ar'=>'لديك رسالة جديدة من '.$name,
//            'note_en'=>' you have new message from '.$name
//        ]);
        return $this->sendResponse(new JobResourse($job));
    }

    public function update($id, JobStoreRequest $request): object
    {
        $job = Job::find($id);
        if (!$job || ($job->company_id != auth('api')->id())) {
            return $this->sendError('توجد مشكلة بالبيانات');
        }
        $job->update($request->validated());
        return $this->sendResponse(new JobResourse($job));
    }

    public function delete($id): object
    {
        $job = Job::find($id);
        if (!$job || ($job->company_id != auth('api')->id())) {
            return $this->sendError('توجد مشكلة بالبيانات');
        }
        $job->delete();
        $jobs = Job::where('company_id', auth('api')->id())->paginate(10);
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
        $jobs = $job_q->pluck('expected_salary')->toArray();
        if (count($jobs) == 0) {
            return $this->sendResponse(0);
        }
        $average = array_sum($jobs) / count($jobs);
        return $this->sendResponse($average);
    }

    public function findAverageSalary(Request $request)
    {
        $jobs = Job::take(7)->get();
        $data = [];
        foreach ($jobs as $job) {
            $arr['job'] = new SimpleJobResourse($job);
            $arr['expected_salary'] = (int)$job->expected_salary;
            $data[] = $arr;
        }
        return $this->sendResponse($data);
    }

    public function subscribes($job_id, Request $request)
    {
        $subscribes = JobSubscribe::where('job_id', $job_id);
        if ($request['countries']) {
            $countries = explode(',', $request['countries']);
            $users = User::whereIn('country_id', $countries)->pluck('id')->toArray();
            $subscribes = $subscribes->whereIn('user_id', $users);
        }
        if ($request['cities']) {
            $cities = explode(',', $request['cities']);
            $users = User::whereIn('city_id', $cities)->pluck('id')->toArray();
            $subscribes = $subscribes->whereIn('user_id', $users);
        }
        if ($request['sex']) {
            $users = Profile::where('sex', $request['sex'])->pluck('user_id')->toArray();
            $subscribes = $subscribes->whereIn('user_id', $users);
        }
        if ($request['experience_years']) {
            $users = Experience::where('experience_years', $request['experience_years'])->pluck('user_id')->toArray();
            $subscribes = $subscribes->whereIn('user_id', $users);
        }
        $subscribes = $subscribes->latest()->get();
        $subscribes_arr = [];
        foreach ($subscribes as $subscribe) {
            $subscribe_arr['user'] = new SimpleUserResourse($subscribe->user);
            $subscribe_arr['cv'] = $subscribe->cv ? new CvResource($subscribe->cv) : new Object_();
            $subscribe_arr['message'] = $subscribe->message??"";
            $subscribe_arr['subscribed_from'] = Carbon::parse($subscribe->created_at)->diffForHumans();
            $subscribes_arr[] = $subscribe_arr;
        }
        return $this->sendResponse($subscribes_arr);
    }

}
