<?php

namespace App\Services\Register\Email;

use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Account;

class EmailRegisterStep2Service extends ServiceBase
{
    protected function handleLogic()
    {
        $email = $this->data['email'];
        $smscode = $this->data['smscode'];
        $account = Account::where("email", "=", $email)->where("smscode", "=", $smscode)->where("email_status", "=", 0)->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Wrong email address or smscode"), [__("Wrong email address or smscode")], [], 401);
        }
        $account->update([
            "email_status" => 1,
            "smscode" => null
        ]);
        return $this->responder()->success(__("Email address confirmed"), [], [], 200);
    }
    public function validateRules(): array
    {
        return [
            "email" => ["required", "email", "max:60", "exists:user_accounts,email"],//TODO exists
            "smscode" => ["required", "string", "digits:4", "exists:user_accounts,smscode"]//TODO exists
        ];
    }
}