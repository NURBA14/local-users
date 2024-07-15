<?php

namespace App\Enums\Users\Profiles;

use App\Enums\EnumTrait;


enum ProfileStatus: int
{
    use EnumTrait;

    case EMPTY = 0;
    case FILLED = 100;
    case CONFIRMED = 110;

    public static function labels()
    {
        return [
            static::EMPTY ->value => __("Не заполнен"),
            static::FILLED->value => __("Заполнен"),
            static::CONFIRMED->value => __("Подтвержден"),
        ];
    }
}
