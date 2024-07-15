<?php

namespace App\Services\Register\Email;

use App\Base\ServiceBase\ServiceBase;
use App\Mail\EmailRegisterMail;
use App\Models\Users\Account;
use Illuminate\Support\Facades\Mail;

class EmailRegisterStep1Service extends ServiceBase
{
    protected function handleLogic()
    {
        $smscode = Account::smscodeGenerate();
        $email = $this->data['email'];
        $account = Account::where("email", "=", $email)->where("email_status", "=", 0)->first();
        if (!is_null($account)) {
            return $this->responder()->error(__("You already have an account"), [__("You already have an account")], [], 400);
        }
        $data = [
            "email" => $email,
            "smscode" => $smscode
        ];
        $account = Account::createNew($data, []);
        Mail::to($email)->send(new EmailRegisterMail($email, $smscode));
        return $this->responder()->success(__("The SMS code has been sent to the mail"), [], [], 200);
    }
    public function validateRules(): array
    {
        return [
            "email" => ["required", "email", "max:60"]
        ];
    }
}