<?php

namespace App\Http\Controllers\Api\Employer;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\SimpleCompanyResourse;
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

class CompanyController extends MasterController
{

    public function seenCompany()
    {
        return SimpleCompanyResourse::collection(User::where('type','COMPANY')->take(5)->get());
    }
    public function showCompany($id)
    {
        return $this->sendResponse(new SimpleCompanyResourse(User::find($id)));
    }
    public function messageCompany($id,Request $request)
    {
        $sender=User::find(auth()->id());
        $name=$sender->profile->first_name.' '.$sender->profile->last_name;
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
        return $this->sendResponse(new SimpleCompanyResourse(User::find($id)));
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

}
