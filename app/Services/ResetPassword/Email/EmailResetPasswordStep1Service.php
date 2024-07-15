<?php

namespace App\Services\ResetPassword\Email;

use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\AccountStatus;
use App\Mail\ResetPasswordMail;
use App\Models\Users\Account;
use Illuminate\Support\Facades\Mail;

class EmailResetPasswordStep1Service extends ServiceBase
{
    protected function handleLogic()
    {
        $email = $this->data['email'];
        $account = Account::where("email", "=", $email)
            ->where(function ($query) {
                $query->where("status", "=", AccountStatus::ACTIVE)->orWhere("status", "=", AccountStatus::INACTIVE);
            })->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Inccorect email"), [__("Inccorect email")], [], 400);
        }
        $smscode = Account::smscodeGenerate();
        Mail::to($email)->send(new ResetPasswordMail($email, $smscode));
        $account->update([
            "smscode" => $smscode
        ]);
        return $this->responder()->success(__("The SMS code has been sent to the mail"), [], [], 200);
    }

    public function validateRules(): array
    {
        return [
            "email" => ["required", "email", "string", "max:60"]
        ];
    }
}