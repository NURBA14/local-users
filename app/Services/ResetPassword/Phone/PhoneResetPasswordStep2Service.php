<?php

namespace App\Services\ResetPassword\Phone;

use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\AccountStatus;
use App\Models\Users\Account;

class PhoneResetPasswordStep2Service extends ServiceBase
{
    protected function handleLogic()
    {
        $phone = $this->data['phone'];
        $smscode = $this->data['smscode'];
        $account = Account::where("phone", "=", $phone)
            ->where("smscode", "=", $smscode)
            ->where(function ($query) {
                $query->where("status", "=", AccountStatus::ACTIVE)->orWhere("status", "=", AccountStatus::INACTIVE);
            })->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Inccorect phone or smscode"), [__("Inccorect phone or smscode")], [], 400);
        }
        $password = bcrypt($this->data['password']);
        $account->update([
            "smscode" => null,
            "password" => $password
        ]);
        return $this->responder()->success(__("Password is reset"), [], [], 200);
    }

    public function validateRules(): array
    {
        return [
            "phone" => ["required", "string", "starts_with:7", "digits:10"],            
            "smscode" => ["required", "string", "digits:4"],
            "password" => ["required", "string", "max:255", "confirmed"],
            "password_confirmation" => ["required", "string", "max:255"]
        ];
    }
}