<?php

namespace App\Http\Controllers;
use App\CustomResponse\ApiResponse;
use App\Http\Requests\StoreEmergencyRequest;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\StoreMaintenanceTechnicianRequest;
use App\Http\Resources\MaintenanceTechnicianResource;
use App\Models\EmergencyMaintenance;
use App\Models\HistoryService;
use App\Models\MaintenanceTechnician;
use Illuminate\Http\Request;

class MaintenanceTechnicianController extends Controller
{
    use ApiResponse;
    public function getHistory(){
        return HistoryService::with('emergency')->get();
    }

    public function index() {
        $maint = MaintenanceTechnician::all();
        return MaintenanceTechnicianResource::collection($maint);
    }

    public function store(StoreMaintenanceTechnicianRequest $request) {
        $request->validated($request->all());
        $maint = MaintenanceTechnician::create($request->all());
        foreach ($request->emergency_ids as $emergency_id){
            EmergencyMaintenance::create([
                'maintenance_technician_id' => $maint->id,
                'emergency_id' =>  $emergency_id,
            ]);
        }
        return MaintenanceTechnicianResource::make($maint);
    }

    // public function update(UpdateHomeRequest $requst, Home $home) {
    //     $requst->validated($requst->all());
    //     $home->update($requst->all());
    //     return HomeResource::make($home);
    // }

    public function show(MaintenanceTechnician $maint) {
        return MaintenanceTechnicianResource::make($maint);
}

    public function destroy(MaintenanceTechnician $maint){
        $maint->delete();
        return $this->success($maint ,'Deleted Successfully From Our System');
    }
}
