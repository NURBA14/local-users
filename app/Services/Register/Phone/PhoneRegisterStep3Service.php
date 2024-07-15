<?php

namespace App\Services\Register\Phone;

use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Account;
use Illuminate\Support\Str;

class PhoneRegisterStep3Service extends ServiceBase
{
    protected function handleLogic()
    {
        $alphas = array_merge(range('A', 'Z'), range('a', 'z'));
        $password = bcrypt($this->data["password"]);
        $phone = $this->data['phone'];
        $accounts_count = Account::where("phone", "=", $phone)->where("phone_status", "=", 1)->whereNotNull("password")->count();
        $account = Account::where("phone", "=", $phone)->where("phone_status", "=", 1)->whereNull("password")->first();

        if (is_null($account)) {
            return $this->responder()->error(__("Inccorect phone"), [__("Inccorect phone")], [], 400);
        }
        if ($accounts_count > 1) {
            while (Account::where("phone", "=", $phone)->where("phone_status", "=", 1)->where("password", "=", $password)->exists()) {
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
            "phone" => ["required", "string", "starts_with:7", "digits:10", "exists:user_accounts,phone"],//TODO exists
            "password" => ["required", "string", "max:255"]//TODO exists
        ];
    }
}