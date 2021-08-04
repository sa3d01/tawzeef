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
        $user['phone']=$request['phone']??$company->phone;
        $user['email']=$request['email']??$company->email;
        $user['country_id']=$request['country_id']??$company->country_id;
        $user['city_id']=$request['city_id']??$company->city_id;
        $user['major_id']=$request['major_id']??$company->major_id;
        $user['members_count']=$request['members_count']??$company->members_count;
        $company->update($user);
        if ($request['avatar']){
            $company->update([
                'avatar'=>$request['avatar']
            ]);
        }
        $profile['working_type']=$request['working_type']??$company->profile->working_type;
        $profile['location']=$request['location']??$company->profile->location;
        $profile['foundation_name']=$request['foundation_name']??$company->profile->foundation_name;
        $profile['description']=$request['description']??$company->profile->description;
        $company->profile->update($profile);
        if ($request['cover']){
            $company->profile->update([
                'cover'=>$request['cover']
            ]);
        }
        if ($request['commercial_file']){
            $company->profile->update([
                'commercial_file'=>$request['commercial_file']
            ]);
        }


        $socilas['facebook']=$request['facebook'];
        $socilas['twitter']=$request['twitter'];
        $socilas['youtube']=$request['youtube'];
        $socilas['linkedin']=$request['linkedin'];
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
