<?php

namespace App\Services\Register\Phone;

use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Account;

class PhoneRegisterStep1Service extends ServiceBase
{
    protected function handleLogic()
    {
        $smscode = Account::smscodeGenerate();
        $phone = $this->data['phone'];
        $account = Account::where("phone", "=", $phone)->where("phone_status", "=", 0)->first();
        if (!is_null($account)) {
            return $this->responder()->error(__("You already have an account"), [__("You already have an account")], [], 400);
        }
        $data = [
            "phone" => $phone,
            "smscode" => $smscode,
        ];
        $account = Account::createNew($data, []);
        // Отпрвка SMS кода на номер телофона
        return $this->responder()->success(__("The SMS code has been sent to the phone number"), [], [], 200);

    }

    public function validateRules(): array
    {
        return [
            "phone" => ["required", "string", "starts_with:7", "digits:10"]//TODO exists
        ];
    }
}