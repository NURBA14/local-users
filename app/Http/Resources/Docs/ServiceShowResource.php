<?php

namespace App\Http\Resources\Docs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "service" => $this['service'],
            "method" => $this['method'],
            "name" => $this['name'],
            "namespace" => $this['namespace'],
            "filePath" => $this['filePath'],
            "validationRules" => $this['validationRules'],
        ];
    }
}
