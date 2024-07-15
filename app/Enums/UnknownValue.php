<?php

namespace App\Enums;

use App\Enums\EnumTrait;

/**
 * если статус не был найден
 */
enum UnknownValue:string
{
    use EnumTrait;

    case NOTFOUND = 'NOTFOUND';


    public static function labels()
    {
        return [
            static::NOTFOUND->value => __("Значение не найдено!!!"),
        ];
    }

}
