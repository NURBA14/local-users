<?php

namespace App\Services\DefaultList;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\IinStatus;

class IinStatusService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $data = IinStatus::labels();
        return $this->responder()->success(__("Iin status default list"), [], $data, 200);
    }
    public function validateRules(): array
    {
        return [];
    }
}