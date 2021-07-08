<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\ExperienceUpdateRequest;
use App\Http\Requests\Api\Auth\JobRequiredUpdateRequest;
use App\Http\Requests\Api\Auth\ProfileUpdateRequest;
use App\Http\Requests\Api\Auth\QulificationUpdateRequest;
use App\Http\Requests\Api\Auth\SocialUpdateRequest;
use App\Http\Resources\CvResource;
use App\Http\Resources\ExperienceResourse;
use App\Http\Resources\JobRequiredResourse;
use App\Http\Resources\MajorCollection;
use App\Http\Resources\MembershipCollection;
use App\Http\Resources\PersonalInfoResourse;
use App\Http\Resources\QulificationResourse;
use App\Http\Resources\SimpleCompanyResourse;
use App\Http\Resources\SimpleUserResourse;
use App\Http\Resources\SkillCollection;
use App\Http\Resources\SocialResourse;
use App\Http\Resources\TrainingCoursesCollection;
use App\Http\Resources\UserResourse;
use App\Models\Cv;
use App\Models\Experience;
use App\Models\JobRequired;
use App\Models\Major;
use App\Models\Membership;
use App\Models\PremiumRequest;
use App\Models\Qualification;
use App\Models\Skill;
use App\Models\Socials;
use App\Models\TrainingCourse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Object_;

class UserController extends MasterController
{
    public function profile(): object
    {
        $user = auth('api')->user();
        if ($user->type=='COMPANY'){
            return $this->sendResponse(new SimpleCompanyResourse($user));
        }
        return $this->sendResponse(new UserResourse($user));
    }

    public function simpleProfile(): object
    {
        $user = auth('api')->user();
        return $this->sendResponse(new SimpleUserResourse($user));
    }
    public function userCv(): object
    {
        $user = auth('api')->user();
        return $this->sendResponse(CvResource::collection($user->cv));
    }

    public function updateAvatar(Request $request):object
    {
        $this->validate($request, ['avatar' => 'required|image']);
        $user = auth('api')->user();
        $user->update([
            'avatar' => $request->file('avatar')
        ]);
        $arr['avatar'] = $user->avatar;
        return $this->sendResponse($arr);
    }
    public function premium(Request $request)
    {
        $this->validate($request, ['pay_type' => 'required','invoice_image'=>'nullable']);
        PremiumRequest::create([
            'pay_type'=>$request['pay_type'],
            'invoice_image'=>$request['invoice_image'],
            'user_id'=>auth('api')->id(),
        ]);
        //todo:delete later
        $user=auth('api')->user();
        $user->profile->update([
           'premium'=>true
        ]);
        return $this->sendResponse(new SimpleUserResourse($user));
    }
    function uploadFile($file,$dest)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($dest, $filename);
        return $filename;
    }
    public function uploadCv(Request $request)
    {
        $this->validate($request, ['cv' => 'required']);
        $user = auth('api')->user();
        $cv = $request['cv'];
        $filename = null;
        if (is_file($cv)) {
            $filename = $this->uploadFile($cv,'media/files/cv/');
        } elseif (filter_var($cv, FILTER_VALIDATE_URL) === True) {
            $filename = $cv;
        }
        Cv::create([
            'user_id'=>auth('api')->id(),
            'file'=> $filename
        ]);
        return $this->sendResponse(CvResource::collection($user->cv));
    }
    public function personalInfo(): object
    {
        $user = auth('api')->user();
        return $this->sendResponse(new PersonalInfoResourse($user));
    }
    public function updateProfile(ProfileUpdateRequest $request):object
    {
        $request->validated();
        $user = auth('api')->user();
        $user->update($request->validated());
        $user->profile->update($request->validated());
        return $this->sendResponse(new PersonalInfoResourse($user));
    }

    public function personalSocials(): object
    {
        $user = auth('api')->user();
        return $this->sendResponse($user->socials ? new SocialResourse($user->socials) : new Object_());
    }
    public function updateSocials(SocialUpdateRequest $request): object
    {
        $data = $request->validated();
        $data['user_id'] = auth('api')->id();
        $user = auth('api')->user();
        $user_socials = $user->socials;
        if (!$user_socials) {
            Socials::create($data);
        } else {
            $user->socials->update($request->validated());
        }
        return $this->sendResponse($user->socials ? new SocialResourse($user->socials) : new Object_());
    }

    public function personalContacts(): object
    {
        $user = auth('api')->user();
        $arr['phone'] = $user->phone ?? "";
        $arr['email'] = $user->email;
        return $this->sendResponse($arr);
    }
    public function updateContacts(Request $request):object
    {
        $this->validate($request, ['phone' => 'nullable|string|max:90|unique:users,phone,' . \request()->user()->id, 'email' => 'nullable|string|max:90|unique:users,email,' . \request()->user()->id]);
        $data = $request->only(['email', 'phone']);
        $user = auth('api')->user();
        $user->update($data);
        $arr['phone'] = $user->phone ?? "";
        $arr['email'] = $user->email;
        return $this->sendResponse($arr);
    }

    public function personalQualifications():object
    {
        $user = auth('api')->user();
        return $this->sendResponse($user->qualification ? new QulificationResourse($user->qualification) : new Object_());
    }
    public function updateQualifications(QulificationUpdateRequest $request):object
    {
        $request->validated();
        $user = auth('api')->user();
        $user->update($request->validated());
        $data = $request->validated();
        $data['user_id'] = $user->id;
        if (!$user->qualification) {
            Qualification::create($data);
        } else {
            $user->qualification->update($request->validated());
        }
        return $this->sendResponse($user->qualification ? new QulificationResourse($user->qualification) : new Object_());
    }

    public function personalSubMajors():object
    {
        $user = auth('api')->user();
        return $this->sendResponse($user->profile->sub_majors?new MajorCollection(Major::whereIn('id',$user->profile->sub_majors)->get()):new Object_());
    }
    public function updateSubMajors(Request $request):object
    {
        $user = auth('api')->user();
        $sub_majors=$request['sub_majors'];
        $arr=[];
        foreach ($sub_majors as $sub_major)
        {
            if (!Major::find($sub_major)){
                return $this->sendError('something error');
            }
            $arr[]=$sub_major;
        }
        $user->profile->update([
            'sub_majors'=>$arr
        ]);
        return $this->sendResponse($user->profile->sub_majors?new MajorCollection(Major::whereIn('id',$user->profile->sub_majors)->get()):new Object_());
    }

    public function personalJobRequired():object
    {
        $user = auth('api')->user();
        return $this->sendResponse($user->jobRequired ? new JobRequiredResourse($user->jobRequired) : new Object_());
    }
    public function updateJobRequired(JobRequiredUpdateRequest $request):object
    {
        $request->validated();
        $user = auth('api')->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;
        if (!$user->jobRequired) {
            JobRequired::create($data);
        } else {
            $user->jobRequired->update($request->validated());
        }
        return $this->sendResponse($user->jobRequired ? new JobRequiredResourse($user->jobRequired) : new Object_());
    }

    public function personalTrainingCourses():object
    {
        $user = auth('api')->user();
        return $this->sendResponse(new TrainingCoursesCollection($user->TrainingCourses));
    }
    public function updateTrainingCourses(Request $request):object
    {
        $user = auth('api')->user();
        foreach ($user->TrainingCourses as $trainingCourse){
            $trainingCourse->delete();
        }
        $count=count($request['type']);
        for ($i=0;$i<$count;$i++){
            $data['type']=$request['type'][$i];
            $data['title']=$request['title'][$i];
            $data['foundation_name']=$request['foundation_name'][$i];
            $data['total_hours']=$request['total_hours'][$i];
            $data['start_date']=$request['start_date'][$i];
            $data['end_date']=$request['end_date'][$i];
            $data['graduation_file']=$request['graduation_file'][$i];
            $data['user_id']=$user->id;
            TrainingCourse::create($data);
        }
        return $this->sendResponse(new TrainingCoursesCollection($user->TrainingCourses));
    }

    public function personalExperience():object
    {
        $user = auth('api')->user();
        return $this->sendResponse($user->experience?new ExperienceResourse($user->experience):new Object_());
    }
    public function updateExperience(ExperienceUpdateRequest $request):object
    {
        $request->validated();
        $user = auth('api')->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;
        if (!$user->experience) {
            Experience::create($data);
        } else {
            $user->experience->update($request->validated());
        }
        return $this->sendResponse($user->experience ? new ExperienceResourse($user->experience) : new Object_());
    }

    public function personalMemberships():object
    {
        $user = auth('api')->user();
        return $this->sendResponse(new MembershipCollection($user->memberships));
    }
    public function updateMemberships(Request $request):object
    {
        $user = auth('api')->user();
        foreach ($user->memberships as $membership){
            $membership->delete();
        }
        foreach ($request['memberships'] as $membership){
            $data=$membership;
            $data['user_id']=$user->id;
            Membership::create($data);
        }
        return $this->sendResponse(new MembershipCollection($user->memberships));
    }

    public function personalSkills():object
    {
        $user = auth('api')->user();
        return $this->sendResponse(new SkillCollection($user->skills));
    }
    public function updateSkills(Request $request):object
    {
        $user = auth('api')->user();
        foreach ($user->skills as $skill){
            $skill->delete();
        }
        foreach ($request['skills'] as $skill){
            $data=$skill;
            $data['user_id']=$user->id;
            Skill::create($data);
        }
        return $this->sendResponse(new SkillCollection($user->skills));
    }
}
