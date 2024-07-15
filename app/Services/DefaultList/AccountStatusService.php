<?php

namespace App\Services\DefaultList;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\AccountStatus;

class AccountStatusService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $data = AccountStatus::labels();
        return $this->responder()->success(__("Account status default list"), [], $data, 200);
    }

    public function validateRules(): array
    {
        return [];
    }
}