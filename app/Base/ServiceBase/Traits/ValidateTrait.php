<?php

namespace App\Base\ServiceBase\Traits;

trait ValidateTrait
{
    protected function orderDirs()
    {
        return ["ASC", "DESC", "asc","desc"];
    }
}