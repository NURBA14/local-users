<?php

namespace App\Enums\Users\Accounts;

use App\Enums\EnumTrait;

enum AccountStatus:int
{
    use EnumTrait;

    case ACTIVE = 100;
    case DELETED = 30;
    case BLOCKED = 20;
    case INACTIVE = 0;

    public static function labels()
    {
        return [
            static::INACTIVE->value => __("Не активен"),
            static::BLOCKED->value => __("Блокирован"),
            static::DELETED->value => __("Удален"),
            static::ACTIVE->value => __("Активен"),
        ];
    }
}
