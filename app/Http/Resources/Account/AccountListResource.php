<?php

namespace App\Http\Resources\Account;

use App\Enums\Users\Accounts\AccountStatus;
use App\Enums\Users\Accounts\ConfirmedStatus;
use App\Enums\Users\Accounts\IinStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountListResource extends JsonResource
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
        ];
    }
}
