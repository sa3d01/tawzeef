<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\CompanyRegisterationRequest;
use App\Http\Requests\Api\Auth\UserRegisterationRequest;
use App\Http\Resources\CompanyLoginResourse;
use App\Http\Resources\UserLoginResourse;
use App\Mail\VerifyMail;
use App\Models\Cv;
use App\Models\Profile;
use App\Models\User;
use App\Models\VerifyUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Mockery\Exception;
use Spatie\Permission\Models\Role;

class RegisterController extends MasterController
{

    public function userRegister(UserRegisterationRequest $request): object
    {
        $data = $request->validated();
        $data['last_ip'] = $request->ip();
        $data['type'] = 'USER';

        $user = User::create($data);
        $user->refresh();
        $role = Role::findOrCreate($user->type);
        $user->assignRole($role);
        $data['user_id'] = $user->id;
        if ($request->has('cv')){
            $cv = $request['cv'];
            $filename = null;
            if (is_file($cv)) {
                $filename = $this->uploadFile($cv,'media/files/cv/');
            } elseif (filter_var($cv, FILTER_VALIDATE_URL) === True) {
                $filename = $cv;
            }
            Cv::create([
                'user_id'=>$user->id,
                'file'=> $filename
            ]);
        }
        Profile::create($data);
        //verification email
        VerifyUser::create([
            'user_id' => $user->id,
            'token' =>rand(1111,9999)// sha1(time())
        ]);

        try {
            Mail::to($user->email)->send(new VerifyMail($user));
        }catch (\Exception $e){

        }
        return $this->sendResponse(new UserLoginResourse($user));
    }
    public function companyRegister(CompanyRegisterationRequest $request): object
    {
        $data = $request->validated();
        $data['last_ip'] = $request->ip();
        $data['type'] = 'COMPANY';
        if ($request['major_id']==null){
            $data['major_id'] = $request['sector_id'];
        }
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
        //verification email
        VerifyUser::create([
            'user_id' => $user->id,
            'token' => rand(1111,9999)//sha1(time())
        ]);
        try {
            Mail::to($user->email)->send(new VerifyMail($user));
        }catch (\Exception $e){

        }
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

    public function verifyUser(Request $request)
    {
        $user=User::where('email',$request['email'])->first();
        if (!$user){
            return $this->sendError('هذا الحساب غير موجود.');
        }
        $verifyUser = VerifyUser::where(['token'=> $request['token'],'email'=>$request['email']])->first();
        if(isset($verifyUser) ){
            if($user->email_verified_at==null) {
                $user->update([
                    'email_verified_at'=>Carbon::now()
                ]);
            }
        }else{
            return $this->sendError('كود التفعيل غير صحيح.');
        }
        if ($user['type']!='USER'){
            return $this->sendResponse(new CompanyLoginResourse($user));
        }else{
            return $this->sendResponse(new UserLoginResourse($user));
        }
    }
}
