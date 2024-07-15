<?php

namespace App\Services\Confirm\Phone;

use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Account;

class PhoneConfirmStep1Service extends ServiceBase
{
    protected function handleLogic()
    {
        $phone = $this->data['phone'];
        $account = Account::where("phone", "=", $phone)->where("phone_status", "=", 0)->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Wrong 'phone'"), [__("Wrong 'phone'")], [], 400);
        }
        $smscode = Account::smscodeGenerate();
        // Отпрвка SMS на номер телефона
        $account->update([
            "smscode" => $smscode
        ]);
        return $this->responder()->success(__("The SMS code has been sent to the phone"), [], [], 200);
    }

    public function validateRules(): array
    {
        return [
            "phone" => ["required", "string", "starts_with:7", "digits:10"]
        ];
    }
}