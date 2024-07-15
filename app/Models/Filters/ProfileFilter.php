<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProfileFilter extends BaseFilter
{
    protected array $filters = [
        "id",
        "account_id",
        "uuid",
        "iin",
        "nickname",
        "name",
        "surname",
        "lastname",
        "birthdate",
        "deathdate",
        "gender_id",
        "nationality_id",
        "resident",
        "father_iin",
        "mother_iin",
        "guardian_iin",
        "status",
        "created_at",
        "updated_at",
    ];

    protected function id(int $value): Builder
    {
        return $this->builder->where('user_profiles.id', "=", $value);
    }
    protected function accountId(int $value): Builder
    {
        return $this->builder->where('user_profiles.account_id', "=", $value);
    }
    protected function uuid(string $value): Builder
    {
        return $this->builder->where('user_profiles.uuid', "LIKE", "%" . $value . "%");
    }
    protected function iin(string $value): Builder
    {
        return $this->builder->where('user_profiles.iin', "LIKE", "%" . $value . "%");
    }
    protected function nickname(string $value): Builder
    {
        return $this->builder->where('user_profiles.nickname', "LIKE", "%" . $value . "%");
    }
    protected function name(string $value): Builder
    {
        return $this->builder->where('user_profiles.name', "LIKE", "%" . $value . "%");
    }
    protected function surname(string $value): Builder
    {
        return $this->builder->where('user_profiles.surname', "LIKE", "%" . $value . "%");
    }
    protected function lastname(string $value): Builder
    {
        return $this->builder->where('user_profiles.lastname', "LIKE", "%" . $value . "%");
    }
    protected function birthdate(string $value): Builder
    {
        return $this->builder->where('user_profiles.birthdate', "LIKE", "%" . $value . "%");
    }
    protected function deathdate(string $value): Builder
    {
        return $this->builder->where('user_profiles.deathdate', "LIKE", "%" . $value . "%");
    }
    protected function genderId(int $value): Builder
    {
        return $this->builder->where('user_profiles.gender_id', "=", $value);
    }
    protected function nationalityId(int $value): Builder
    {
        return $this->builder->where('user_profiles.nationality_id', "=", $value);
    }
    protected function resident(int $value): Builder
    {
        return $this->builder->where('user_profiles.resident', "=", $value);
    }
    protected function fatherIin(string $value): Builder
    {
        return $this->builder->where('user_profiles.father_iin', "LIKE", "%" . $value . "%");
    }
    protected function motherIin(string $value): Builder
    {
        return $this->builder->where('user_profiles.mother_iin', "LIKE", "%" . $value . "%");
    }
    protected function guardianIin(string $value): Builder
    {
        return $this->builder->where('user_profiles.guardian_iin', "LIKE", "%" . $value . "%");
    }
    protected function status(int $value): Builder
    {
        return $this->builder->where('user_profiles.status', "=", $value);
    }
    protected function createdAt(string $value): Builder
    {
        return $this->builder->where('user_profiles.created_at', "LIKE", "%" . $value . "%");
    }
    protected function updatedAt(string $value): Builder
    {
        return $this->builder->where('user_profiles.updated_at', "LIKE", "%" . $value . "%");
    }
}