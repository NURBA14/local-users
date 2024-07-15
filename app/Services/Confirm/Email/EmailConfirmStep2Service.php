<?php

namespace App\Services\Confirm\Email;

use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Account;

class EmailConfirmStep2Service extends ServiceBase
{
    protected function handleLogic()
    {
        $email = $this->data['email'];
        $smscode = $this->data['smscode'];
        $account = Account::where("email", "=", $email)->where("smscode", "=", $smscode)->where("email_status", "=", 0)->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Wrong email address or smscode"), [__("Wrong email address or smscode")], [], 400);
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
            "email" => ["required", "email", "string", "max:60"],
            "smscode" => ["required", "string", "digits:4"],
        ];
    }
}