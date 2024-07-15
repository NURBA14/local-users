<?php

namespace App\Services\Admin;

use App\Enums\Users\Accounts\AccountStatus;
use App\Enums\Users\Accounts\IinStatus;
use App\Enums\Users\Profiles\ProfileStatus;
use App\Http\Resources\UserInfoResource;
use App\Models\Users\Account;
use App\Base\ServiceBase\ServiceBase;

class UserCreateService extends ServiceBase
{
    protected function handleLogic()
    {
        $iin = $this->data['iin'];
        if (Account::where("iin", "=", $iin)->exists()) {
            return $this->responder()->error(__("Account with this `iin` already exists"), [__("Account with this `iin` already exists")], [], 400);
        }
        $account_data = $this->data;
        $profile_data = $this->data;
        $account_data['status'] = AccountStatus::ACTIVE->value;
        $account_data['iin_status'] = IinStatus::ADMIN->value;
        $profile_data['status'] = ProfileStatus::CONFIRMED->value;
        $account = Account::createNew($account_data, $profile_data);
        return $this->responder()->success(__("User created"), [], new UserInfoResource($account), 201);
    }

    public function validateRules(): array
    {
        return [
            // Account
            "iin" => ["required", "string", "digits:12"],
            "phone" => ["nullable", "string", "starts_with:7", "digits:10"],
            "email" => ["nullable", "string", "max:60", "email"],
            "login" => ["nullable", "string", "max:20"],
            // Profile
            "nickname" => ["nullable", "string", "max:50"],
            "name" => ["nullable", "string", "max:100"],
            "surname" => ["nullable", "string", "max:100"],
            "lastname" => ["nullable", "string", "max:100"],
            "birthdate" => ["nullable", "date", "date_format:Y-m-d"],
            "deathdate" => ["nullable", "date", "date_format:Y-m-d"],
            "resident" => ["nullable", "integer", "in:0,1"],
            "gender_id" => ["nullable", "integer", "exists:genders,id"],
            "nationality_id" => ["nullable", "integer", "exists:nationalities,id"],
            "father_iin" => ["nullable", "string", "digits:12"],
            "mother_iin" => ["nullable", "string", "digits:12"],
            "guardian_iin" => ["nullable", "string", "digits:12"],
        ];
    }
}