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

    public function validateToken($email,$token):object
    {
        $passwordResetObject = PasswordReset::where([
            'email' => $email,
            'token' => $token,
        ])->first();
        if (!$passwordResetObject) {
            return $this->sendError('Wrong token! Please try again.');
        }
        $user = User::where('email', $email)->first();
        return $this->sendResponse($user);
    }
    public function setPassword($email,$token,Request $request):object
    {
        $passwordResetObject = PasswordReset::where([
            'email' => $email,
            'token' => $token,
        ])->first();
        if (!$passwordResetObject) {
            return $this->sendError('Wrong token! Please try again.');
        }
        $user = User::where('email', $email)->first();
        DB::transaction(function () use ($user, $passwordResetObject, $request) {
            $user->update(['password' => $request['password']]);
        });
        if ($user['type']!='USER'){
            return $this->sendResponse(new CompanyLoginResourse($user));
        }else{
            return $this->sendResponse(new UserLoginResourse($user));
        }
    }

}
