<?php

namespace App\Http\Resources;

use App\Models\MaintenanceTechnician;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'services' => $this->services,
            'description' => $this->description,
            'image' => asset($this->image),
            // 'relationship' => [
            //     'MaintenanceTechnician' =>
            //      MaintenanceTechnicianResource::collection(MaintenanceTechnician::whereHas('emergencyMaintenance' , fn($query) => 
            //         $query->where('emergency_id' , $this->id)
            //     )->get()),
            // ]
        ];
    }
}
