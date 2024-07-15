<?php

namespace App\Enums\Users\Accounts;

use App\Enums\EnumTrait;

enum ConfirmedStatus: int
{
    use EnumTrait;

    case TRUE = 1;
    case FALSE = 0;

    public static function labels()
    {
        return [
            static::TRUE->value => __("Подтвержден"),
            static::FALSE->value => __("Не подтвержден"),
        ];
    }
}
