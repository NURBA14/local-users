<?php

namespace App\Services\Register\Email;

use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Account;
use Illuminate\Support\Str;

class EmailRegisterStep3Service extends ServiceBase
{
    protected function handleLogic()
    {
        $alphas = array_merge(range('A', 'Z'), range('a', 'z'));
        $password = bcrypt($this->data['password']);
        $email = $this->data['email'];
        $accounts_count = Account::where("email", "=", $email)->where("email_status", "=", 1)->whereNotNull("password")->count();
        $account = Account::where("email", "=", $email)->where("email_status", "=", 1)->whereNull("password")->first();

        if (is_null($account)) {
            return $this->responder()->error(__("Inccorect email"), [__("Inccorect email")], [], 400);
        }
        if ($accounts_count > 1) {
            while (Account::where("email", "=", $email)->where("email_status", "=", 1)->where("password", "=", $password)->exists()) {
                $password_base = rand(2, 2) . Str::random(2);
                $password = bcrypt($password_base);
            }
        }
        $data = [];
        if (!empty($password_base)) {
            $data = ["password" => $password_base];
        }

        $account->update([
            "password" => $password
        ]);
        return $this->responder()->success("You are registered", [], $data, 200);
    }

    public function validateRules(): array
    {
        return [
            "email" => ["required", "email", "exists:user_accounts,email"],//TODO exists
            "password" => ["required", "string", "max:255"]//TODO exists
        ];
    }
}