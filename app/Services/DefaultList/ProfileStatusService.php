<?php

namespace App\Services\DefaultList;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Profiles\ProfileStatus;

class ProfileStatusService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $data = ProfileStatus::labels();
        return $this->responder()->success(__("Profile status default list"), [], $data, 200);
    }
    public function validateRules(): array
    {
        return [];
    }
}