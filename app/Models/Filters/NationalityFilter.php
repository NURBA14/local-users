<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class NationalityFilter extends BaseFilter
{
    protected array $filters = ['id', 'name_rus', 'name_kaz'];

    protected function id(int $value): Builder
    {
        return $this->builder->where('nationalities.id', "=", $value);
    }
    protected function nameRus(string $value): Builder
    {
        return $this->builder->where('nationalities.name_rus', "LIKE", "%" . $value . "%");
    }
    protected function nameKaz(string $value): Builder
    {
        return $this->builder->where('nationalities.name_kaz', "LIKE", "%" . $value . "%");
    }
}