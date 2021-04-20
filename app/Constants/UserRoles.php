<?php

namespace App\Constants;

class UserRoles
{
    public const Manager= 'Manager';
    public const SAdmin= 'S.Admin';
    public const  Admin= 'Admin';
    public const  Operative= 'Operativo';
    public const User= 'Usuario';


    public static function toArray(): array
    {
        return
        [
            self::Manager,
            self::SAdmin,
            self::Admin,
            self::Operative,
            self::User,      
        ];
    }
}