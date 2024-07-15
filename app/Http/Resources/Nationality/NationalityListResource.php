<?php

namespace App\Http\Resources\Nationality;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NationalityListResource extends JsonResource
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
            "name_rus" => $this->name_rus,
            "name_kaz" => $this->name_kaz,
            "profiles_count" => $this->profiles_count
        ];
    }
}
