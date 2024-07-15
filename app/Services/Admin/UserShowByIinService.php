<?php

namespace App\Services\Admin;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Http\Resources\UserInfoResource;
use App\Models\Users\Account;
use App\Base\ServiceBase\ServiceBase;

class UserShowByIinService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;

    protected function handleLogic()
    {
        $iin = $this->data["iin"];
        $account = Account::with(["profile", 'profile.gender', 'profile.nationality'])->where("iin", "=", $iin)->first();
        if (is_null($account)) {
            return $this->responder()->error(__("User not found"), [__("User not found")], [], 404);
        }
        return $this->responder()->success(__("Successfully found user"), [], new UserInfoResource($account), 200);
    }

    public function validateRules(): array
    {
        return [
            "iin" => ["required", "string", "digits:12"]
        ];
    }
}