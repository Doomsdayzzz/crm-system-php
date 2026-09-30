<?php

namespace App\Enums;

enum RoleListEnum: string
{
    case USER = 'Пользователь';
    case ADMIN = 'Админ';

    public static function label(): array
    {
        return [
            'admin' => self::ADMIN,
            'user' => self::USER,
        ];
    }
}

