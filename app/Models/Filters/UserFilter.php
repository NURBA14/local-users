<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;


class UserFilter extends BaseFilter
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

        "profile_id",
        "profile_uuid",
        "profile_iin",
        "profile_nickname",
        "profile_name",
        "profile_surname",
        "profile_lastname",
        "profile_birthdate",
        "profile_deathdate",
        "profile_resident",
        "profile_father_iin",
        "profile_mother_iin",
        "profile_guardian_iin",
        "profile_status",
        "profile_created_at",
        "profile_updated_at",

        "gender_id",
        "nationality_id",
    ];

    //=============================================================Account
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


    //=============================================================Profile
    protected function profileId(int $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.id', "LIKE", "%" . $value . "%");
    }
    protected function profileUuid(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.uuid', "LIKE", "%" . $value . "%");
    }
    protected function profileIin(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.iin', "LIKE", "%" . $value . "%");
    }
    protected function profileNickname(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.nickname', "LIKE", "%" . $value . "%");
    }
    protected function profileName(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.name', "LIKE", "%" . $value . "%");
    }
    protected function profileSurname(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.surname', "LIKE", "%" . $value . "%");
    }
    protected function profileLastname(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.lastname', "LIKE", "%" . $value . "%");
    }
    protected function profileBirthdate(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.birthdate', "LIKE", "%" . $value . "%");
    }
    protected function profileDeathdate(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.deathdate', "LIKE", "%" . $value . "%");
    }
    protected function genderId(int $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.gender_id', "=", $value);
    }
    protected function nationalityId(int $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.nationality_id', "=", $value);
    }
    protected function profileResident(int $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.resident', "=", $value);
    }
    protected function profileFatherIin(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.father_iin', "LIKE", "%" . $value . "%");
    }
    protected function profileMotherIin(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.mother_iin', "LIKE", "%" . $value . "%");
    }
    protected function profileGuardianIin(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.guardian_iin', "LIKE", "%" . $value . "%");
    }
    protected function profileStatus(int $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.status', "=", $value);
    }
    protected function profileCreatedAt(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.created_at', "LIKE", "%" . $value . "%");
    }
    protected function profileUpdatedAt(string $value): Builder
    {
        return $this->builder->whereRelation('profile', 'user_profiles.updated_at', "LIKE", "%" . $value . "%");
    }
}