<?php

namespace App\Http\Resources;

use App\Models\Emergency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceTechnicianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'image' => $this->image,
            'stuts' =>$this->stuts,
            'relationship' => [
                'EmergencyServices' =>
                 EmergencyResource::collection(Emergency::whereHas('emergencyMaintenance' , fn($query) => 
                    $query->where('maintenance_technician_id' , $this->id)
                )->get()),
            ]
        ];
    }
}