<?php

namespace App\Enums\Users\Accounts;

use App\Enums\EnumTrait;


enum IinStatus:int
{
    use EnumTrait;

    case FALSE = 0;
    case ADMIN = 100;
    case MEDIANA = 110;
    case ECP = 200;
    case GBDFL = 210;

    public static function labels()
    {
        return [
            static::FALSE->value => __("Не подтвержден"),
            static::ADMIN->value => __("Подтвержден админом"),
            static::MEDIANA->value => __("Подтвержден Медианой"),
            static::ECP->value => __("Подтвержден ECP"),
            static::GBDFL->value => __("Подтвержден GBDFL"),
        ];
    }
}
