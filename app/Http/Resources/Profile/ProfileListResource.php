<?php

namespace App\Http\Resources\Profile;

use App\Enums\Users\Profiles\ProfileStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileListResource extends JsonResource
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
            "account_id" => $this->account_id,
            "uuid" => $this->uuid,
            "iin" => $this->iin,
            "nickname" => $this->nickname,
            "name" => $this->name,
            "surname" => $this->surname,
            "lastname" => $this->lastname,
            "birthdate" => $this->birthdate,
            "deathdate" => $this->deathdate,
            "gender" => [
                "id" => $this->gender->id ?? null,
                "name" => $this->gender->name ?? null,
                "title" => $this->gender->title ?? null,
            ],
            "nationality" => [
                "id" => $this->nationality->id ?? null,
                "name_rus" => $this->nationality->name_rus ?? null,
                "name_kaz" => $this->nationality->name_kaz ?? null,
            ],
            "resident" => $this->resident,
            "father_iin" => $this->father_iin,
            "mother_iin" => $this->mother_iin,
            "guardian_iin" => $this->guardian_iin,
            "status" => ProfileStatus::selectByCode($this->status),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
