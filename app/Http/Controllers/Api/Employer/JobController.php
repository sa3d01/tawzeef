<?php

namespace App\Http\Controllers\Api\Employer;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResourse;
use App\Http\Resources\SimpleUserResourse;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobRequired;
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

    public function show($id): object
    {
        $job = Job::find($id);

        return $this->sendResponse(new JobResourse($job));
    }

    public function notifyNewJob(Request $request):object
    {
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
        if ($request['sex']) {
            $expected_sex_users = Profile::where('sex', $request['sex'])->pluck('user_id');
            $job_q = $job_q->whereIn('id', $expected_sex_users);
        }
        if ($request['salary_from']) {
            $expected_salary_users = JobRequired::where('expected_salary', '>', $request['salary_from'])->pluck('user_id');
            $job_q = $job_q->whereIn('id', $expected_salary_users);
        }
        if ($request['salary_to']) {
            $expected_salary_users = JobRequired::where('expected_salary', '<', $request['salary_to'])->pluck('user_id');
            $job_q = $job_q->whereIn('id', $expected_salary_users);
        }
        if ($request['experience_years']) {
            $experience_users = Experience::where('experience_years', $request['experience_years'])->pluck('user_id');
            $job_q = $job_q->whereIn('id', $experience_users);
        }
        $employee = $job_q->get();
        return $this->sendResponse(SimpleUserResourse::collection($employee));
    }

}
