<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\UserResourse;
use Illuminate\Http\Request;
use App\Models\Socials;
use App\Http\Requests\Api\Auth\ProfileUpdateRequest;
use App\Http\Requests\Api\Auth\SocialUpdateRequest;
class UserController extends MasterController
{
    public function profile(): object
    {
        $user = auth('api')->user();
        return $this->sendResponse(new UserResourse($user));
    }

    public function updateAvatar(Request $request)
    {
        $this->validate($request, ['avatar' => 'required|image']);
        $user = auth('api')->user();
        $user->update([
            'avatar' => $request->file('avatar')
        ]);
        return $this->sendResponse(new UserResourse($user));
    }
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $request->validated();
        $user = auth('api')->user();
        $user->update($request->validated());
        $user->profile->update($request->validated());
        return $this->sendResponse(new UserResourse($user));
    }
    public function updateSocials(SocialUpdateRequest $request)
    {
        $data=$request->validated();
        $data['user_id']=auth('api')->id();
        $user = auth('api')->user();
        $user_socials=$user->socials;
        if (!$user_socials){
            Socials::create($data);
        }else{
            $user->socials->update($request->validated());
        }
        return $this->sendResponse(new UserResourse($user));
    }


}
