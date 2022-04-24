<?php

namespace App\Http\Resources;

use App\Models\Major;
use App\Models\Socials;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Object_;
use App\Http\Resources\SocialResourse;
class CompanyResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $social=Socials::where('user_id',$this->id)->first();
        return [
            'id' => (int)$this->id,
            'approved' => (bool)$this->approved,
            'type' => $this->type,
            'phone' => $this->phone??"",
            'email' => $this->email,
            'country'=>new CountryResourse($this->country),
            'city'=>new CityResourse($this->city),
            'working_type'=>$this->profile->working_type,
            'major'=>new MajorResourse($this->major),
            'members_count' => (int)$this->members_count,
            'avatar' => $this->avatar,
            'cover' => $this->profile->cover,
            'location' => $this->profile->location ?? new Object_(),
            'commercial_file' => $this->profile->commercial_file,
            'foundation_name' => $this->profile->foundation_name,
            'description' => $this->profile->description,
            'facebook'=>$social->facebook??"",
            'twitter'=>$social->twitter??"",
            'youtube'=>$social->youtube??"",
            'linkedin'=>$social->linkedin??"",
        ];
    }
}
