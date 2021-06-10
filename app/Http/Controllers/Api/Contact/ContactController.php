<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\ContactRequest;
use App\Models\Contact;
use App\Models\ContactType;
use App\Models\Notification;
use Illuminate\Support\Str;

class ContactController extends MasterController
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function contactTypes(): object
    {
        $data = ContactType::all();
        $results = [];
        foreach ($data as $datum) {
            $result['id'] = $datum->id;
            $arr['ar']=$datum->name_ar;
            $arr['en']=$datum->name_en;
            $result['name'] =$arr;
            $results[] = $result;
        }
        return $this->sendResponse($results);
    }

    public function store(ContactRequest $request): object
    {
        $data = $request->validated();
        if (auth('api')->check()){
            $data['user_id'] = auth('api')->id();
        }else{
            $data['name'] =$request['name'];
            $data['phone'] =$request['phone'];
        }
        $contact=Contact::create($data);
//        $this->notifyAdmin($contact);
        return $this->sendResponse([], " تم الارسال بنجاح .. يرجى انتظار رد الإدارة");
    }

    function notifyAdmin($contact)
    {
        Notification::create([
            'receiver_id'=>1,
            'type'=>'admin',
            'title'=>'رسالة تواصل',
            'note'=>Str::limit($contact->message,100),
            'more_details'=>[
                'type'=>'contact',
                'contact_id'=>$contact->id
            ]
        ]);

    }
}
