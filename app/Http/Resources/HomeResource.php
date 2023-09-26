<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tenant_name' => $this-> tenant_name,
            'apartment_number' => $this-> apartment_number,
            'apartment_name' => $this-> apartment_name,
            'floor' => $this-> floor,
        ];
    }
}
