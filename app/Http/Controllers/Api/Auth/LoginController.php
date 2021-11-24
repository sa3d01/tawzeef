<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\CompanyLoginResourse;
use App\Http\Resources\UserLoginResourse;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LoginController extends MasterController
{
    public function login(LoginRequest $request): object
    {
        $credentials = $request->only('email', 'password');
        $user = User::where(['email' => $request['email'], 'type' => $request['type']])->first();
        if (!$user) {
            return $this->sendError('هذا الحساب غير موجود.');
        }
        if ($user->email_verified_at==null){
            VerifyUser::create([
                'user_id' => $user->id,
                'token' => rand(1111,9999)//sha1(time())
            ]);
            try {
                Mail::to($user->email)->send(new VerifyMail($user));
            }catch (\Exception $e){

            }
        }
        if (auth('api')->attempt($credentials)) {
            if ($user['type']!='USER'){
                return $this->sendResponse(new CompanyLoginResourse($user));
            }else{
                return $this->sendResponse(new UserLoginResourse($user));
            }
        }
        return $this->sendError('كلمة المرور غير صحيحة.');
    }

//    public function resendCode(Request $request)
//    {
//        $user = User::where(['email' => $request['email'], 'type' => $request['type']])->first();
//        if (!$user) {
//            return $this->sendError('هذا الحساب غير موجود.');
//        }
//        VerifyUser::create([
//            'user_id' => $user->id,
//            'token' => rand(1111,9999)//sha1(time())
//        ]);
//        Mail::to($user->email)->send(new VerifyMail($user));
//    }
    public function logout(): object
    {
        auth('api')->logout();
        return $this->sendResponse([], "Logged out successfully.");
    }
}
