<?php

namespace App\Traits;

use App\Models\PasswordReset;
use Carbon\Carbon;

trait UserPasswordResetTrait
{
    protected function createPasswordResetCodeForUser($user):array
    {
        $data = [
            'email' => $user->email,
            'token' => sha1(time()),
            'expired_at' => Carbon::now()->addMinutes(15),
        ];
        PasswordReset::create($data);
        return $data;
    }
}
