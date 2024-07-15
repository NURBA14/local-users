<?php

namespace App\Http\Resources\Gender;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenderListResource extends JsonResource
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
            "name" => $this->name,
            "title" => $this->title,
            "profiles_count" => $this->profiles_count
        ];
    }
}
