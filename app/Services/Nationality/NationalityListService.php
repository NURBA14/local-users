<?php

namespace App\Services\Nationality;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Http\Resources\Nationality\NationalityListPaginateResource;
use App\Models\Filters\NationalityFilter;
use App\Models\Users\Nationality;
use Illuminate\Validation\Rule;

class NationalityListService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $per_page = $this->data['per_page'] ?? 10;
        $sort_col = $this->data['sort_col'] ?? "id";
        $sort_dir = $this->data['sort_dir'] ?? "ASC";

        $filter = new NationalityFilter($this->data);
        $nationalities = Nationality::withCount("profiles")
            ->filter($filter)
            ->orderBy($sort_col, $sort_dir)
            ->paginate($per_page);
        return $this->responder()->success(__("Nationalities list"), [], new NationalityListPaginateResource($nationalities));
    }

    public function validateRules(): array
    {
        return [
            "per_page" => ["nullable", "integer", "max:100"],
            "id" => ['nullable', 'integer'],
            "name_rus" => ['nullable', 'string'],
            "name_kaz" => ['nullable', 'string'],
            "sort_col" => ["nullable", "string", Rule::in(Nationality::getColumnsList())],
            "sort_dir" => ["nullable", "string", Rule::in($this->orderDirs())]
        ];
    }
}