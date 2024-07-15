<?php

namespace App\Services\DefaultList;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\ConfirmedStatus;

class ConfirmStatusService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $data = ConfirmedStatus::labels();
        return $this->responder()->success(__("Confirm status default list"), [], $data, 200);
    }

    public function validateRules(): array
    {
        return [];
    }
}