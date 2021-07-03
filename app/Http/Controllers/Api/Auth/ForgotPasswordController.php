<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\CompanyLoginResourse;
use App\Http\Resources\UserLoginResourse;
use App\Mail\SetNewPassword;
use App\Mail\VerifyMail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\VerifyUser;
use App\Traits\UserPasswordResetTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends MasterController
{
    use UserPasswordResetTrait;

    public function sendResetLink(Request $request):object
    {
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            return $this->sendError('هذا الحساب غير موجود.');
        }
        $this->createPasswordResetCodeForUser($user);
        Mail::to($user->email)->send(new SetNewPassword($user));
        $response = [
            'status' => 200,
            'message' => 'يرجي مراجعة بريدك الإلكتروني.',
            'data' => [],
        ];
        return response()->json($response);
    }

    public function validateToken($token):object
    {
        $passwordResetObject = PasswordReset::where([
            'token' => $token,
        ])->latest()->first();
        if (!$passwordResetObject) {
            return $this->sendError('Wrong token! Please try again.');
        }
        if (Carbon::now()->gt(Carbon::parse($passwordResetObject->expired_at))) {
            return $this->sendError('Token expired. Please request a new one');
        }
        $user = User::where('email',  $passwordResetObject->email)->first();
        return $this->sendResponse($user);
    }
    public function setPassword($token,Request $request):object
    {
        $passwordResetObject = PasswordReset::where([
            'email' =>  $request['email'],
            'token' => $token,
            'reset_at'=>null
        ])->latest()->first();
        if (!$passwordResetObject) {
            return $this->sendError('Wrong token! Please try again.');
        }
        if (Carbon::now()->gt(Carbon::parse($passwordResetObject->expired_at))) {
            return $this->sendError('Token expired. Please request a new one');
        }
        $user = User::where('email',  $request['email'])->first();
        DB::transaction(function () use ($user, $passwordResetObject, $request) {
            $passwordResetObject->update(['reset_at' => Carbon::now()]);
            $user->update(['password' => $request['password']]);
        });
        if ($user['type']!='USER'){
            return $this->sendResponse(new CompanyLoginResourse($user));
        }else{
            return $this->sendResponse(new UserLoginResourse($user));
        }
    }

}
