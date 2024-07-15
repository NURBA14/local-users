<?php

namespace App\Services\DefaultList;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Gender;

class GendersDefaultListService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $data = Gender::all();
        return $this->responder()->success(__("Nationalities Default list"), [], $data, 200);
    }
    public function validateRules(): array
    {
        return [];
    }
}