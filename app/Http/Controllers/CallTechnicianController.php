<?php

namespace App\Http\Controllers;

use App\CustomResponse\ApiResponse;
use App\Http\Requests\StoreCallTechnician;
use App\Http\Requests\UpdateHomeRequest;
use App\Http\Requests\UpdateCallTechnician;
use App\Http\Resources\CallTechnicianResource;
use App\Models\CallTechnician;
use App\Models\HistoryService;
use App\Models\Home;
use Illuminate\Http\Request;

class CallTechnicianController extends Controller
{
    use ApiResponse;
    public function index() {
        //  $callTechnician = CallTechnician::all();
        //  return $callTechnician->CallTechnicianResource::with('maintenanceTechnician','emergency');
        return CallTechnician::with('maintenanceTechnician','emergency')->get();
    }

    
    public function store(StoreCallTechnician $requst) {
        $requst->validated($requst->all());
        $callTechnician = CallTechnician::create($requst->all());

        HistoryService::create([
             'emergency_id' => $requst->emergency_id,
             'emergency' => $requst->emergency,
            'title' => $requst->problems_descrption,
        ]);

        return CallTechnicianResource::make($callTechnician);
    }


    public function show(CallTechnician $callTechnician) {
        return CallTechnicianResource::make($callTechnician);
    }

    public function destroy(CallTechnician $callTechnician){
        $callTechnician->delete();
        return $this->success($callTechnician,'Deleted Successfully From Our System');
    }
}
