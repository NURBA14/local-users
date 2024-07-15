<?php

namespace App\Services\Register\Phone;

use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Account;

class PhoneRegisterStep2Service extends ServiceBase
{
    protected function handleLogic()
    {
        $phone = $this->data['phone'];
        $smscode = $this->data['smscode'];
        $account = Account::where("phone", "=", $phone)->where("smscode", "=", $smscode)->where("phone_status", "=", 0)->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Wrong phone or smscode"), [__("Wrong phone or smscode")], [], 401);
        }
        $account->update([
            "phone_status" => 1,
            "smscode" => null
        ]);
        return $this->responder()->success(__("Phone confirmed"), [], [], 200);
    }

    public function validateRules(): array
    {
        return [
            "phone" => ["required", "string", "starts_with:7", "digits:10", "exists:user_accounts,phone"],//TODO exists
            "smscode" => ["required", "string", "digits:4", "exists:user_accounts,smscode"]
        ];
    }
}