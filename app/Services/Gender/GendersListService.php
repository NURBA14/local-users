<?php

namespace App\Services\Gender;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Http\Resources\Gender\GenderListPaginateResource;
use App\Models\Filters\GenderFilter;
use App\Models\Users\Gender;
use Illuminate\Validation\Rule;

class GendersListService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $per_page = $this->data['per_page'] ?? 10;
        $sort_col = $this->data['sort_col'] ?? "id";
        $sort_dir = $this->data['sort_dir'] ?? "ASC";

        $filter = new GenderFilter($this->data);
        $genders = Gender::withCount("profiles")
            ->filter($filter)
            ->orderBy($sort_col, $sort_dir)
            ->paginate($per_page);
        return $this->responder()->success(__("Genders list"), [], new GenderListPaginateResource($genders));
    }
    public function validateRules(): array
    {
        return [
            "per_page" => ["nullable", "integer", "max:100"],
            "id" => ['nullable', 'integer'],
            "name" => ['nullable', 'string'],
            "title" => ['nullable', 'string'],
            "sort_col" => ["nullable", "string", Rule::in(Gender::getColumnsList())],
            "sort_dir" => ["nullable", "string", Rule::in($this->orderDirs())]
        ];
    }
}