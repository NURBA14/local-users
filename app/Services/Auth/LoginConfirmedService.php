<?php

namespace App\Services\Auth;

use App\Enums\Users\Accounts\AccountStatus;
use App\Enums\Users\Accounts\IinStatus;
use App\Http\Resources\UserInfoResource;
use App\Base\ServiceBase\ServiceBase;
use App\Models\Users\Account;
use Illuminate\Support\Facades\Auth;

class LoginConfirmedService extends ServiceBase
{
    protected function handleLogic()
    {
        $username = $this->data['username'];
        $password = $this->data['password'];
        $ip = $this->data['ip'];
        $device = $this->data['device'];

        $credentials = [];
        $error_prefix = null;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $credentials = ["email" => $username, "password" => $password];
            $error_prefix = "wrong email";
        } elseif (filter_var((integer) $username, FILTER_VALIDATE_INT) and str()->length((string) $username) == 12) {
            $credentials = ["iin" => $username, "password" => $password];
            $error_prefix = "wrong iin";
        } elseif (filter_var((integer) $username, FILTER_VALIDATE_INT) and str()->length((string) $username) == 10) {
            $credentials = ["phone" => $username, "password" => $password];
            $error_prefix = "wrong phone";
        } else {
            $credentials = ["login" => $username, "password" => $password];
            $error_prefix = "wrong login";
        }

        $account = Account::whereNotNull("password")
            ->where(function ($query) use ($username) {
                $query->where("email", "=", $username)->orWhere("iin", "=", $username)
                    ->orWhere("phone", "=", $username)->orWhere("login", "=", $username);
            })->exists();

        if (!$account) {
            return $this->responder()->error(__("Failed authentication"), [$error_prefix . " " . __("or wrong password")], [], 400);
        }

        if (!Auth::guard("accounts")->once($credentials)) {
            return $this->responder()->error(__("Failed authentication"), [$error_prefix . " " . __("or wrong password")], [], 401);
        }
        $account = Auth::guard("accounts")->user();
        if ($account->status !== AccountStatus::ACTIVE->value) {
            $status = AccountStatus::selectByCode($account->status);
            return $this->responder()->error(__("Forbidden"), [__("Account status {$status}")], [], 403);
        }
        if ($account->iin_status < IinStatus::ADMIN->value) {
            return $this->responder()->error(__("Forbidden"), [__("Not confirmed IIN")], [], 403);
        }

        $account->update([
            "last_visit" => now(),
            "last_ip" => $ip,
            "last_device" => $device
        ]);
        $profile = $account->profile;
        $profile->gender;
        $profile->nationality; // Таким образом запршаиваю связяанные данные из таблицы Профилей
        return $this->responder()->success(__("Successful confirmed login"), [], new UserInfoResource($account), 200);
    }

    public function validateRules(): array
    {
        return [
            "username" => ["required", "max:60"],
            "password" => ["required", "string", "max:255"],
            "ip" => ["required", "ip", "max:45"],
            "device" => ["required", "string", "max:255"]
        ];
    }
}