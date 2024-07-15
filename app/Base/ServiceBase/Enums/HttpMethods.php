<?php

namespace App\Base\ServiceBase\Enums;

use App\Enums\EnumTrait;

enum HttpMethods: string
{
    use EnumTrait;
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case DELETE = "DELETE";
    case PATCH = "PATCH";
    public static function labels()
    {
        return [
            static::GET->value => __("GET"),
            static::POST->value => __("POST"),
            static::PUT->value => __("PUT"),
            static::DELETE->value => __("DELETE"),
            static::PATCH->value => __("PATCH"),
        ];
    }
}