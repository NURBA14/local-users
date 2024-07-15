<?php

namespace App\Services\DefaultList;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Nationality;

class NationalitiesDefaultListService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $data = Nationality::all();
        return $this->responder()->success(__("Nationalities Default list"), [], $data, 200);
    }
    public function validateRules(): array
    {
        return [];
    }
}