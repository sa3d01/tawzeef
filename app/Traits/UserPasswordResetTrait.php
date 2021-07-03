<?php

namespace App\Traits;

use App\Models\PasswordReset;

trait UserPasswordResetTrait
{
    protected function createPasswordResetCodeForUser($user):array
    {
        $data = [
            'email' => $user->email,
            'token' => sha1(time()),
        ];
        PasswordReset::create($data);
        return $data;
    }
}
