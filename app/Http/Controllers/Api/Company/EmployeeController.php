<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\SimpleUserResourse;
use App\Http\Resources\UserResourse;
use App\Models\Experience;
use App\Models\JobRequired;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeController extends MasterController
{
    public function findEmployee(Request $request)
    {
        $employee_q = User::where('type', 'USER');
        if ($request['job_title']) {
            $expected_title_users = JobRequired::where('job_title', 'LIKE', $request['job_title'])->pluck('user_id');
            $employee_q = $employee_q->whereIn('id', $expected_title_users);
        }
        if ($request['country']) {
            $countries=explode($request['country'],',');
            $employee_q = $employee_q->whereIn('country_id', $countries);
        }
        if ($request['city']) {
            $cities=explode($request['city'],',');
            $employee_q = $employee_q->whereIn('city_id', $cities);
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
    public function messages()
    {
        $messages=Message::where('receiver_id',auth()->id())->get();
        foreach ($messages as $message){
            $message->update([
               'read'=>true
            ]);
        }
        return new MessageCollection(Message::where('receiver_id',auth()->id())->paginate());
    }
    public function messageEmployee($id,Request $request)
    {
        $sender=User::find(auth()->id());
        $name=$sender->profile->foundation_name;
        $message=Message::create([
            'sender_id'=>auth()->id(),
            'receiver_id'=>$id,
            'message'=>$request['message']
        ]);
        Notification::create([
            'receiver_id'=>$id,
            'model'=>'Message',
            'model_id'=>$message->id,
            'note_ar'=>'لديك رسالة جديدة من '.$name,
            'note_en'=>' you have new message from '.$name
        ]);
        return $this->sendResponse(new UserResourse(User::find($id)));
    }
}
