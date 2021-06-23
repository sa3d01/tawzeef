<?php

namespace App\Http\Enums;

final class UserRole
{
    public const ROLE_SUPER_ADMIN = 1;
    public const ROLE_ADMIN = 2;
    public const ROLE_USER = 3;
    public const ROLE_COMPANY = 4;


    public const ROLES = [
        self::ROLE_SUPER_ADMIN => "SUPER_ADMIN",
        self::ROLE_ADMIN => "ADMIN  ",
        self::ROLE_USER => "USER",
        self::ROLE_COMPANY => "COMPANY",
    ];

    public static function of(int $roleId): string
    {
        return self::ROLES[$roleId];
    }
}
