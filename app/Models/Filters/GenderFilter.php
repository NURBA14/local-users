<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class GenderFilter extends BaseFilter
{
    protected array $filters = ['id', 'name', 'title'];

    protected function id(int $value): Builder
    {
        return $this->builder->where('genders.id', "=", $value);
    }
    protected function name(string $value): Builder
    {
        return $this->builder->where('genders.name', "LIKE", "%" . $value . "%");
    }
    protected function title(string $value): Builder
    {
        return $this->builder->where('genders.title', "LIKE", "%" . $value . "%");
    }
}
