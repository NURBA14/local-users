<?php

namespace App\Services\Users;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Http\Resources\Profile\ProfileListPaginateResource;
use App\Models\Filters\ProfileFilter;
use App\Models\Users\Profile;
use Illuminate\Validation\Rule;

class ProfileListService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $per_page = $this->data["per_page"] ?? 10;
        $sort_col = $this->data["sort_col"] ?? "id";
        $sort_dir = $this->data["sort_dir"] ?? "ASC";

        $filter = new ProfileFilter($this->data);
        $profiles = Profile::with(["gender", "nationality"])
            ->filter($filter)
            ->orderBy($sort_col, $sort_dir)
            ->paginate($per_page);
        return $this->responder()->success(__("Profiles list"), [], new ProfileListPaginateResource($profiles));
    }

    public function validateRules(): array
    {
        return [
            "per_page" => ["nullable", "integer", "max:100"],
            "sort_col" => ["nullable", "string", Rule::in(Profile::getColumnsList())],
            "sort_dir" => ["nullable", "string", Rule::in($this->orderDirs())],
            "id" => ["nullable", "integer"],
            "account_id" => ["nullable", "integer"],
            "uuid" => ["nullable", "string"],
            "iin" => ["nullable", "string"],
            "nickname" => ["nullable", "string"],
            "name" => ["nullable", "string"],
            "surname" => ["nullable", "string"],
            "lastname" => ["nullable", "string"],
            "birthdate" => ["nullable", "date", "date_format:Y-m-d"],
            "deathdate" => ["nullable", "date", "date_format:Y-m-d"],
            "gender_id" => ["nullable", "integer"],
            "nationality_id" => ["nullable", "integer"],
            "resident" => ["nullable", "integer"],
            "father_iin" => ["nullable", "string"],
            "mother_iin" => ["nullable", "string"],
            "guardian_iin" => ["nullable", "string"],
            "status" => ["nullable", "integer"],
            "created_at" => ["nullable", "date", "date_format:Y-m-d H:i:s"],
            "updated_at" => ["nullable", "date", "date_format:Y-m-d H:i:s"],
        ];
    }
}