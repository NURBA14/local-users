<?php

namespace App\Services\Users;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Http\Resources\User\UserListPaginateResource;
use App\Models\Filters\UserFilter;
use App\Models\Users\Account;
use Illuminate\Validation\Rule;
use App\Models\Users\Gender;
use App\Models\Users\Nationality;
use App\Models\Users\Profile;

class UsersListService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $per_page = $this->data["per_page"] ?? 10;
        $sort_col = $this->data["sort_col"] ?? "id";
        $sort_dir = $this->data["sort_dir"] ?? "ASC";

        $filter = new UserFilter($this->data);
        $users = Account::with(["profile", "profile.gender", "profile.nationality"])
            ->filter($filter)
            ->orderBy($sort_col, $sort_dir)
            ->paginate($per_page);
        return $this->responder()->success(__("Users List"), [], new UserListPaginateResource($users));
    }

    public function validateRules(): array
    {
        return [
            "per_page" => ["nullable", "integer", "max:100"],
            "sort_col" => ["nullable", "string", Rule::in(array_merge(Account::getColumnsList(), Profile::getColumnsList(), Gender::getColumnsList(), Nationality::getColumnsList()))],
            "sort_dir" => ["nullable", "string", Rule::in($this->orderDirs())],
            //============================Account
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
            //============================profile
            "profile_id" => ["nullable", "integer"],
            "profile_uuid" => ["nullable", "string"],
            "profile_iin" => ["nullable", "string"],
            "profile_nickname" => ["nullable", "string"],
            "profile_name" => ["nullable", "string"],
            "profile_surname" => ["nullable", "string"],
            "profile_lastname" => ["nullable", "string"],
            "profile_birthdate" => ["nullable", "date", "date_format:Y-m-d"],
            "profile_deathdate" => ["nullable", "date", "date_format:Y-m-d"],
            "profile_resident" => ["nullable", "integer"],
            "profile_father_iin" => ["nullable", "string"],
            "profile_mother_iin" => ["nullable", "string"],
            "profile_guardian_iin" => ["nullable", "string"],
            "profile_status" => ["nullable", "integer"],
            "profile_created_at" => ["nullable", "date", "date_format:Y-m-d H:i:s"],
            "profile_updated_at" => ["nullable", "date", "date_format:Y-m-d H:i:s"],
            //============================gender and nationality
            "gender_id" => ["nullable", "integer"],
            "nationality_id" => ["nullable", "integer"]
        ];
    }
}