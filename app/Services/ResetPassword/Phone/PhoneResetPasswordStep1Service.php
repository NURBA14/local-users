<?php

namespace App\Services\ResetPassword\Phone;

use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\AccountStatus;
use App\Models\Users\Account;

class PhoneResetPasswordStep1Service extends ServiceBase
{
    protected function handleLogic()
    {
        $phone = $this->data['phone'];
        $account = Account::where("phone", "=", $phone)
            ->where(function ($query) {
                $query->where("status", "=", AccountStatus::ACTIVE)->orWhere("status", "=", AccountStatus::INACTIVE);
            })->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Inccorect phone"), [__("Inccorect phone")], [], 400);
        }
        $smscode = Account::smscodeGenerate();
        // Send smscode to phone number
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