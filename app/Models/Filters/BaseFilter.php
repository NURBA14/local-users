<?php

namespace App\Models\Filters;

use Filterable\Filter;
use Illuminate\Database\Eloquent\Builder;

class BaseFilter extends Filter
{
    protected $data;
    protected Builder $builder;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function apply(Builder $builder, ?array $options = []): Builder
    {
        $this->builder = $builder;
        foreach ($this->data as $key => $value) {
            $method = str()->camel($key);
            if (method_exists($this, $method)) {
                if (!empty($value)) {
                    $this->$method($value);
                }
            }
        }
        return $this->builder;
    }
}