<?php

namespace App\Services\Register;

use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\AccountStatus;
use App\Enums\Users\Accounts\IinStatus;
use App\Enums\Users\Profiles\ProfileStatus;
use App\Http\Resources\UserInfoResource;
use App\Models\Users\Account;
use Illuminate\Support\Facades\Http;

class EcpRegisterService extends ServiceBase
{
    protected function handleLogic()
    {
        $response = $this->query();
        if ($response->status !== 200) {
            return $this->responder()->error(__("Incorrect 'ecp' or 'ecp_password'"), [$response->message], [], 400);
        }
        if (Account::where("iin", "=", $response->data->iin)->exists()) {
            return $this->responder()->error(__("An account with this data already exists"), [__("An account with this data already exists")], [], 400);
        }
        $accountData = [
            "iin" => $response->data->iin,
            "iin_status" => IinStatus::ECP->value,
            "status" => AccountStatus::ACTIVE->value,
        ];
        $profileData = [
            "iin" => $response->data->iin,
            "name" => str($response->data->name)->title(),
            "surname" => str($response->data->surname)->title(),
            "lastname" => str($response->data->lastname)->title(),
            "birthdate" => $response->data->birthdate,
            "status" => ProfileStatus::CONFIRMED->value
        ];
        $account = Account::createNew($accountData, $profileData);
        return $this->responder()->success(__("Account created"), [], new UserInfoResource($account), 200);
    }

    private function query()
    {
        $response = Http::asForm()->post(env("ECP_URL"), [
            "service" => env("ECP_SERVICE"),
            "token" => env("ECP_TOKEN"),
            "ecp" => $this->data['ecp'],
            "password" => $this->data['ecp_password']
        ]);
        return json_decode($response->body());
    }

    public function validateRules(): array
    {
        return [
            "ecp" => ["required", "string"],
            "ecp_password" => ["required", "string"],
            "password" => ["required", "string", "max:255", "confirmed"],
            "password_confirmation" => ["required", "string", "max:255"]
        ];
    }
}