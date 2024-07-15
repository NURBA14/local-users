<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class AccountFilter extends BaseFilter
{
    protected array $filters = [
        "id",
        "uuid",
        "iin",
        "iin_status",
        "phone",
        "phone_status",
        "email",
        "email_status",
        "login",
        "pincode",
        "status",
        "last_visit",
        "last_device",
        "last_ip",
        "created_at",
        "updated_at",
    ];

    protected function id(int $value): Builder
    {
        return $this->builder->where('user_accounts.id', "=", $value);
    }
    protected function uuid(string $value): Builder
    {
        return $this->builder->where('user_accounts.uuid', "LIKE", "%" . $value . "%");
    }
    protected function iin(string $value): Builder
    {
        return $this->builder->where('user_accounts.iin', "LIKE", "%" . $value . "%");
    }
    protected function iinStatus(int $value): Builder
    {
        return $this->builder->where('user_accounts.iin_status', "=", $value);
    }
    protected function phone(string $value): Builder
    {
        return $this->builder->where('user_accounts.phone', "LIKE", "%" . $value . "%");
    }
    protected function phoneStatus(int $value): Builder
    {
        return $this->builder->where('user_accounts.phone_status', "=", $value);
    }
    protected function email(string $value): Builder
    {
        return $this->builder->where('user_accounts.email', "LIKE", "%" . $value . "%");
    }
    protected function emailStatus(int $value): Builder
    {
        return $this->builder->where('user_accounts.email_status', "=", $value);
    }
    protected function login(string $value): Builder
    {
        return $this->builder->where('user_accounts.login', "LIKE", "%" . $value . "%");
    }
    protected function pincode(string $value): Builder
    {
        return $this->builder->where('user_accounts.pincode', "LIKE", "%" . $value . "%");
    }
    protected function status(int $value): Builder
    {
        return $this->builder->where('user_accounts.status', "=", $value);
    }
    protected function lastVisit(string $value): Builder
    {
        return $this->builder->where('user_accounts.last_visit', "LIKE", "%" . $value . "%");
    }
    protected function lastDevice(string $value): Builder
    {
        return $this->builder->where('user_accounts.last_device', "LIKE", "%" . $value . "%");
    }
    protected function lastIp(string $value): Builder
    {
        return $this->builder->where('user_accounts.last_ip', "LIKE", "%" . $value . "%");
    }
    protected function createdAt(string $value): Builder
    {
        return $this->builder->where('user_accounts.created_at', "LIKE", "%" . $value . "%");
    }
    protected function updatedAt(string $value): Builder
    {
        return $this->builder->where('user_accounts.updated_at', "LIKE", "%" . $value . "%");
    }
}