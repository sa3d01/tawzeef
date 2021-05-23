<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\CompanyResourse;
use App\Models\Socials;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyController extends MasterController
{
    public function profile()
    {
        $company = auth('api')->user();
        return $this->sendResponse(new CompanyResourse($company));
    }
    public function updateProfile(Request $request)
    {
        $company = auth('api')->user();
        $user['phone']=$request['phone'];
        $user['email']=$request['email'];
        $user['country_id']=$request['country_id'];
        $user['city_id']=$request['city_id'];
        $user['major_id']=$request['major_id'];
        $user['members_count']=$request['members_count'];
        $user['avatar']=$request['avatar'];
        $profile['working_type']=$request['working_type'];
        $profile['cover']=$request['cover'];
        $profile['location']=$request['location'];
        $profile['commercial_file']=$request['commercial_file'];
        $profile['foundation_name']=$request['foundation_name'];
        $profile['description']=$request['description'];
        $socilas['facebook']=$request['facebook'];
        $socilas['twitter']=$request['twitter'];
        $socilas['youtube']=$request['youtube'];
        $socilas['linkedin']=$request['linkedin'];
        $company->update($user);
        $company->profile->update($profile);
        $social=Socials::where('user_id',$company->id)->first();
        if (!$social){
            $socilas['user_id']=$company->id;
            $social=Socials::create($socilas);
        }else{
            $social->update($socilas);
        }
        return $this->sendResponse(new CompanyResourse($company));
    }
}
