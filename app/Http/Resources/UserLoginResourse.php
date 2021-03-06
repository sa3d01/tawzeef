<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $token = auth('api')->login(User::find($this->id));
        User::find($this->id)->update([
            'last_login_at' => Carbon::now(),
            'last_ip' => $request->ip(),
        ]);
        $empty_cv_obj['id']=0;
        $empty_cv_obj['file']='https://';
        $empty_cv_arr[]=$empty_cv_obj;

        return [
            "user" => [
                'id' => (int)$this->id,
                'premium'=>$this->profile->premium==1,
                'type' => $this->type,
                'phone' => $this->phone,
                'email' => $this->email,
                'email_verified' => (bool)$this->email_verified_at!=null,
                'avatar' => $this->avatar,
                'first_name' => $this->profile->first_name,
                'last_name' => $this->profile->last_name,
                'cv' => count($this->cv)>0?CvResource::collection($this->cv):$empty_cv_arr,
            ],
            "access_token" => [
                'approved' => (bool)$this->approved,
                'token' => $token,
                'token_type' => 'Bearer',
            ],

        ];
    }
}
