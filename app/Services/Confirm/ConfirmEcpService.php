<?php

namespace App\Services\Confirm;

use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\IinStatus;
use App\Http\Resources\UserInfoResource;
use App\Models\Users\Account;
use Illuminate\Support\Facades\Http;

class ConfirmEcpService extends ServiceBase
{
    protected function handleLogic()
    {
        $response = $this->query();
        if ($response->status !== 200) {
            return $this->responder()->error(__("Incorrect 'ecp' or 'ecp_password'"), [$response->message], [], 400);
        }
        $account = Account::where('uuid', "=", $this->data['uuid'])
            ->whereNotIn("iin_status", [IinStatus::ECP])
            ->first();
        if (is_null($account)) {
            return $this->responder()->error(__("Incorrect UUID"), [__("Incorrect UUID")], [], 400);
        }
        $account->update([
            "iin_status" => IinStatus::ECP->value,
            "iin" => $response->data->iin,
        ]);
        $account->profile()->update([
            "iin" => $response->data->iin,
            "birthdate" => $response->data->birthdate,
            "name" => str($response->data->name)->title(),
            "surname" => str($response->data->surname)->title(),
            "lastname" => str($response->data->lastname)->title(),
        ]);
        return $this->responder()->success(__("Successfull ECP confirm"), [], [], 200);
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
            "uuid" => ["required", "string", "uuid"],
            "ecp" => ["required", "string"],
            "ecp_password" => ["required", "string"]
        ];
    }
}