<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HostResource extends JsonResource
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
            'type' => $this-> type,
            'host_number' => $this-> host_number,
            'apartment_number' => $this-> apartment_number,
            'floor_number' => $this-> floor_number,
            'from' => $this-> from,
            'to' => $this-> to,
        ];
    }
}
