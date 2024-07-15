<?php

namespace App\Http\Resources\User;

use App\Enums\Users\Accounts\AccountStatus;
use App\Enums\Users\Accounts\ConfirmedStatus;
use App\Enums\Users\Accounts\IinStatus;
use App\Enums\Users\Profiles\ProfileStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "uuid" => $this->uuid,
            "iin" => $this->iin,
            "iin_status" => IinStatus::selectByCode($this->iin_status),
            "phone" => $this->phone,
            "phone_status" => ConfirmedStatus::selectByCode($this->phone_status),
            "email" => $this->email,
            "email_status" => ConfirmedStatus::selectByCode($this->email_status),
            "login" => $this->login,
            "pincode" => $this->pincode,
            "status" => AccountStatus::selectByCode($this->status),
            "last_visit" => $this->last_visit,
            "last_device" => $this->last_device,
            "last_ip" => $this->last_ip,
            "created_at" => $this->created_at,
            "update_at" => $this->updated_at,
            "profile" => [
                "id" => $this->profile->id,
                "uuid" => $this->profile->uuid,
                "iin" => $this->profile->iin,
                "nickname" => $this->profile->nickname,
                "name" => $this->profile->name,
                "surname" => $this->profile->surname,
                "lastname" => $this->profile->lastname,
                "birthdate" => $this->profile->birthdate,
                "deathdate" => $this->profile->deathdate,
                "gender" => [
                    "id" => $this->profile->gender->id ?? null,
                    "name" => $this->profile->gender->name ?? null,
                    "title" => $this->profile->gender->title ?? null,
                ],
                "nationality" => [
                    "id" => $this->profile->nationality->id ?? null,
                    "name_rus" => $this->profile->nationality->name_rus ?? null,
                    "name_kaz" => $this->profile->nationality->name_kaz ?? null,
                ],
                "resident" => $this->profile->resident,
                "father_iin" => $this->profile->father_iin,
                "mother_iin" => $this->profile->mother_iin,
                "guardian_iin" => $this->profile->guardian_iin,
                "status" => ProfileStatus::selectByCode($this->profile->status),
                "created_at" => $this->profile->created_at,
                "updated_at" => $this->profile->updated_at,
            ]
        ];
    }
}
