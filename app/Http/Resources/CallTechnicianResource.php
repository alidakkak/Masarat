<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CallTechnicianResource extends JsonResource
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
            'customer_name' => $this->customer_name,
            'floor_number' => $this->floor_number,
            'apartment_number' => $this->apartment_number,
            'problems_descrption' => $this->problems_descrption,
            'problems_evel' => $this->problems_evel,
            'maintenance_technician_id' => $this->maintenance_technician_id,

        ];
    }
}
