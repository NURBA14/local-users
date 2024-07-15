<?php

namespace App\Services\Users;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Http\Resources\Account\AccountListPaginateResource;
use App\Models\Filters\AccountFilter;
use App\Models\Users\Account;
use Illuminate\Validation\Rule;

class AccountListService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $per_page = $this->data["per_page"] ?? 10;
        $sort_col = $this->data["sort_col"] ?? "id";
        $sort_dir = $this->data["sort_dir"] ?? "ASC";

        $filter = new AccountFilter($this->data);
        $accounts = Account::filter($filter)
            ->orderBy($sort_col, $sort_dir)
            ->paginate($per_page);
        return $this->responder()->success(__("Accounts list"), [], new AccountListPaginateResource($accounts));
    }

    public function validateRules(): array
    {
        return [
            "per_page" => ["nullable", "integer", "max:100"],
            "sort_col" => ["nullable", "string", Rule::in(Account::getColumnsList())],
            "sort_dir" => ["nullable", "string", Rule::in($this->orderDirs())],
            "id" => ["nullable", "integer"],
            "uuid" => ["nullable", "string"],
            "iin" => ["nullable", "string"],
            "iin_status" => ["nullable", "integer"],
            "phone" => ["nullable", "string"],
            "phone_status" => ["nullable", "integer"],
            "email" => ["nullable", "string", "email"],
            "email_status" => ["nullable", "integer"],
            "login" => ["nullable", "string"],
            "pincode" => ["nullable", "string"],
            "status" => ["nullable", "integer"],
            "last_visit" => ["nullable", "date", "date_format:Y-m-d H:i:s"],
            "last_device" => ["nullable", "string"],
            "last_ip" => ["nullable", "string"],
            "created_at" => ["nullable", "date", "date_format:Y-m-d H:i:s"],
            "updated_at" => ["nullable", "date", "date_format:Y-m-d H:i:s"],
        ];
    }
}