<?php

namespace App\Http\Resources;

use App\Models\CompanySeen;
use App\Models\Major;
use App\Models\Socials;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Object_;
use App\Http\Resources\SocialResourse;
class SimpleUserResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $company_seen=false;
        if (auth('api')->check()){
            $seen=CompanySeen::where([
                'company_id'=>auth('api')->id(),
                'user_id'=>$this->id,
            ])->first();
            if ($seen){
                $company_seen=true;
            }
        }
        return [
            'id' => (int)$this->id,
            'company_seen' => $company_seen,
            'premium'=>$this->profile?$this->profile->premium==1:false,
            'completedProfileRatio'=>$this->completedProfileRatio(),
            'type' => $this->type,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->avatar,
            'first_name' => $this->profile?$this->profile->first_name:"",
            'last_name' => $this->profile?$this->profile->last_name:"",
            'created_at'=>Carbon::parse($this->created_at)->format('Y-m-d')
        ];
    }
}
