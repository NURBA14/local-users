<?php

namespace App\Services\ResetPassword\Email;

use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\AccountStatus;
use App\Models\Users\Account;

class EmailResetPasswordStep2Service extends ServiceBase
{
    protected function handleLogic()
    {
        $email = $this->data['email'];
        $smscode = $this->data['smscode'];
        $account = Account::where("email", "=", $email)
            ->where("smscode", "=", $smscode)
            ->where(function ($query) {
                $query->where("status", "=", AccountStatus::ACTIVE)->orWhere("status", "=", AccountStatus::INACTIVE);
            })->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Inccorect email or smscode"), [__("Inccorect email or smscode")], [], 400);
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
            "email" => ["required", "email", "string", "max:60"],
            "smscode" => ["required", "string", "digits:4"],
            "password" => ["required", "string", "max:255", "confirmed"],
            "password_confirmation" => ["required", "string", "max:255"]
        ];
    }
}