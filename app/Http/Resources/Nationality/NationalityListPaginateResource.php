<?php

namespace App\Http\Resources\Nationality;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NationalityListPaginateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "items" => NationalityListResource::collection($this->items()),
            'pagination' => [
                "current_page" => $this->currentPage(),
                "total" => $this->total(),
                "count" => $this->count(),
                "per_page" => $this->perPage(),
                "path" => $this->getOptions("path")['path'],
                "from" => $this->firstItem(),
                "to" => $this->lastItem(),
                "links" => $this->linkCollection()->toArray(),
                "first_page" => 1,
                "first_page_url" => $this->url(1),
                "last_page" => $this->lastPage(),
                "last_page_url" => $this->url($this->lastPage()),
                "prev_page" => $this->currentPage() - 1,
                "prev_page_url" => $this->previousPageUrl(),
                "next_page" => $this->currentPage() + 1,
                "next_page_url" => $this->nextPageUrl(),
            ],
        ];
    }
}
