<?php

namespace App\Http\Controllers\Api\Employer;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\CompanyResourse;
use App\Http\Resources\JobCollection;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\SimpleCompanyResourse;
use App\Models\CompanySeen;
use App\Models\Job;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends MasterController
{

    public function seenCompany()
    {
        $companies_id = CompanySeen::where('user_id', auth('api')->id())->pluck('company_id')->toArray();
        return SimpleCompanyResourse::collection(User::whereIn('id', $companies_id)->get());
    }

    public function showCompany($id)
    {
        $company = User::find($id);
        $data['company'] = new CompanyResourse($company);
        $data['similar_companies'] = SimpleCompanyResourse::collection(User::where(['type' => 'COMPANY', 'major_id' => $company->major_id])->get());
        $jobs = Job::where('status','!=','rejected')->where('company_id', $company->id)->get();
        $data['jobs'] = new JobCollection($jobs);
        return $this->sendResponse($data);
    }

    public function messageCompany($id, Request $request)
    {
        $sender = User::find(auth()->id());
        $name = $sender->profile->first_name . ' ' . $sender->profile->last_name;
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $id,
            'message' => $request['message']
        ]);
        Notification::create([
            'receiver_id' => $id,
            'model' => 'Message',
            'model_id' => $message->id,
            'note_ar' => 'لديك رسالة جديدة من ' . $name,
            'note_en' => ' you have new message from ' . $name
        ]);
        return $this->sendResponse(new SimpleCompanyResourse(User::find($id)));
    }

    public function messages()
    {
        $messages = Message::where('receiver_id', auth()->id())->get();
        foreach ($messages as $message) {
            $message->update([
                'read' => true
            ]);
        }
        return new MessageCollection(Message::where('receiver_id', auth()->id())->paginate());
    }

}
