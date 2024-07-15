<?php

namespace App\Services\Confirm\Email;

use App\Base\ServiceBase\ServiceBase;
use App\Mail\EmailConfirmMail;
use App\Models\Users\Account;
use Illuminate\Support\Facades\Mail;

class EmailConfirmStep1Service extends ServiceBase
{
    protected function handleLogic()
    {
        $email = $this->data['email'];
        $account = Account::where("email", "=", $email)->where("email_status", 0)->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Wrong 'email'"), [__("Wrong 'email'")], [], 400);
        }
        $smscode = Account::smscodeGenerate();
        Mail::to($email)->send(new EmailConfirmMail($email, $smscode));
        $account->update([
            "smscode" => $smscode
        ]);
        return $this->responder()->success(__("The SMS code has been sent to the mail"), [], [], 200);
    }

    public function validateRules(): array
    {
        return [
            "email" => ["required", "email", "string", "max:60"],
        ];
    }
}