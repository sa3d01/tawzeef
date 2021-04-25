<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\CompanyRegisterationRequest;
use App\Http\Requests\Api\Auth\UserRegisterationRequest;
use App\Http\Resources\CompanyLoginResourse;
use App\Http\Resources\ProviderLoginResourse;
use App\Http\Resources\UserLoginResourse;
use App\Models\Cv;
use App\Models\DropDown;
use App\Models\Profile;
use App\Models\User;
use App\Traits\UserBanksAndCarsTrait;
use App\Traits\UserPhoneVerificationTrait;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RegisterController extends MasterController
{

    public function useRegister(UserRegisterationRequest $request): object
    {
        $data = $request->validated();
        $data['last_ip'] = $request->ip();
        $data['type'] = 'USER';
        $cv = $request['cv'];
        $filename = null;
        if (is_file($cv)) {
            $filename = $this->uploadFile($cv,'media/files/cv/');
        } elseif (filter_var($cv, FILTER_VALIDATE_URL) === True) {
            $filename = $cv;
        }
        $user = User::create($data);
        $user->refresh();
        $role = Role::findOrCreate($user->type);
        $user->assignRole($role);
        $data['user_id'] = $user->id;

        Cv::create([
            'user_id'=>$user->id,
            'file'=> $filename
        ]);
        Profile::create($data);
        return $this->sendResponse(new UserLoginResourse($user));
    }
    public function companyRegister(CompanyRegisterationRequest $request): object
    {
        $data = $request->validated();
        $data['last_ip'] = $request->ip();
        $data['type'] = 'COMPANY';
        $commercial_file = $request['commercial_file'];
        $filename = null;
        if (is_file($commercial_file)) {
            $filename = $this->uploadFile($commercial_file,'media/files/commercial_file/');
        } elseif (filter_var($commercial_file, FILTER_VALIDATE_URL) === True) {
            $filename = $commercial_file;
        }
        $user = User::create($data);
        $user->refresh();
        $role = Role::findOrCreate($user->type);
        $user->assignRole($role);
        $data['user_id'] = $user->id;
        $data['commercial_file'] = $filename;
        Profile::create($data);
        return $this->sendResponse(new CompanyLoginResourse($user));
    }

    function uploadFile($file,$dest)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($dest, $filename);
        return $filename;
    }

    function deleteFileFromServer($filePath)
    {
        if ($filePath != null) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

}
