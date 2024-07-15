<?php

namespace App\Enums;

trait EnumTrait
{

    public static function itemsToString()
    {
        return implode(',', array_column(static::cases(), 'value'));
    }

    public static function items()
    {
        return array_column(static::cases(), 'value');
    }

    public function labels()
    {
    }


    public function label(): string
    {
        return $this->labels()[$this->value] ?? 'enum_label_not_set';
    }

    public static function anyFrom($value)
    {
        return static::tryFrom($value) ?? UnknownValue::NOTFOUND;
    }

    public static function selectByCode($code)
    {
        $found = static::tryFrom($code);

        if (!is_null($found)) {
            return $found->name;
        } else {
            return UnknownValue::NOTFOUND;
        }
    }
}
