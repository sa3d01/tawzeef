<?php

namespace App\Http\Resources;

use App\Models\Major;
use App\Models\Socials;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Object_;
use App\Http\Resources\SocialResourse;
class UserResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'type' => $this->type,
            'cv' => $this->cv->file,
            'job_title' => $this->profile->job_title,
            'avatar' => $this->avatar,
            'latest_updated_at' => Carbon::parse($this->profile->updated_at)->format('Y-m-d'),
            'completedProfileRatio'=>$this->completedProfileRatio(),
            'socials'=>$this->socials?new SocialResourse($this->socials):new Object_(),
            'contacts'=>[
                'phone' => $this->phone??"",
                'email' => $this->email,
            ],
            'personal_information'=>[
                'first_name' => $this->profile->first_name,
                'last_name' => $this->profile->last_name,
                'birthdate' => $this->profile->birthdate?Carbon::parse($this->profile->birthdate)->format('Y-m-d'):"",
                'country' => new CountryResourse($this->country),
                'city' => new CityResourse($this->city),
                'nationality' => $this->profile->nationality?new CountryResourse($this->profile->nationality):"",
                'sex' =>$this->profile->sex??"",
                'social_status' =>$this->profile->social_status??"",
                'members_count' =>$this->members_count,
                'drive_licence_nationality' =>$this->profile->nationality?new CountryResourse($this->profile->driveLicenceNationality):"",
            ],
            'qualifications'=>$this->qualification?new QulificationResourse($this->qualification):new Object_(),
            'sub_majors'=>$this->profile->sub_majors?new MajorCollection(Major::whereIn('id',$this->profile->sub_majors)->get()):new Object_(),
            'job_required'=>$this->jobRequired?new JobRequiredResourse($this->jobRequired):new Object_(),
            'training_courses'=>new TrainingCoursesCollection($this->TrainingCourses),
            'experience'=>$this->experience?new ExperienceResourse($this->experience):new Object_(),
            'memberships'=>new MembershipCollection($this->memberships),
            'skills'=>new SkillCollection($this->skills),
        ];
    }
}
