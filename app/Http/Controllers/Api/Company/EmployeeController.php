<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\SimpleUserResourse;
use App\Http\Resources\UserResourse;
use App\Models\Experience;
use App\Models\JobRequired;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeController extends MasterController
{
    public function findEmployee(Request $request)
    {
        $employee_q = User::where('type', 'USER');
        if ($request['job_title']) {
            $expected_title_users = JobRequired::where('job_title', 'LIKE', $request['job_title'])->pluck('user_id');
            $employee_q = $employee_q->whereIn('id', $expected_title_users);
        }
        if ($request['country_id']) {
            $employee_q = $employee_q->where('country_id', $request['country_id']);
        }
        if ($request['city_id']) {
            $employee_q = $employee_q->where('city_id', $request['city_id']);
        }
        if ($request['sex']) {
            $expected_sex_users = Profile::where('sex', $request['sex'])->pluck('user_id');
            $employee_q = $employee_q->whereIn('id', $expected_sex_users);
        }
        if ($request['salary_from']) {
            $expected_salary_users = JobRequired::where('expected_salary', '>', $request['salary_from'])->pluck('user_id');
            $employee_q = $employee_q->whereIn('id', $expected_salary_users);
        }
        if ($request['salary_to']) {
            $expected_salary_users = JobRequired::where('expected_salary', '<', $request['salary_to'])->pluck('user_id');
            $employee_q = $employee_q->whereIn('id', $expected_salary_users);
        }
        if ($request['experience_years']) {
            $experience_users = Experience::where('experience_years', $request['experience_years'])->pluck('user_id');
            $employee_q = $employee_q->whereIn('id', $experience_users);
        }
        $employee = $employee_q->get();
        return $this->sendResponse(SimpleUserResourse::collection($employee));
    }

    public function showEmployee($id)
    {
        return $this->sendResponse(new UserResourse(User::find($id)));
    }
    public function messageEmployee($id)
    {
        return $this->sendResponse(new UserResourse(User::find($id)));
    }
}
