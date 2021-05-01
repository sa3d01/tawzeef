<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\CompanyLoginResourse;
use App\Http\Resources\UserLoginResourse;
use App\Models\User;

class LoginController extends MasterController
{
    public function login(LoginRequest $request): object
    {
        $credentials = $request->only('email', 'password');
        $user = User::where(['email' => $request['email'], 'type' => $request['type']])->first();
        if (!$user) {
            return $this->sendError('هذا الحساب غير موجود.');
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

    public function logout(): object
    {
        auth('api')->logout();
        return $this->sendResponse([], "Logged out successfully.");
    }
}
