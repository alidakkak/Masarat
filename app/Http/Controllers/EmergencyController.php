<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomResponse\ApiResponse;
use App\Http\Requests\StoreEmergencyRequest;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateEmergencyRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Http\Requests\UpdateHomeRequst;
use App\Http\Resources\EmergencyResource;
use App\Http\Resources\HomeResource;
use App\Models\Emergency;
use App\Models\EmergencyMaintenance;
use App\Models\HistoryService;
use App\Models\Home;
class EmergencyController extends Controller
{
    use ApiResponse;
    public function index() {
        $emergency = Emergency::all();
        return EmergencyResource::collection($emergency);
    }

    public function store(StoreEmergencyRequest $request) {
        $request->validated($request->all());
        $emergency = Emergency::create($request->all());
        // foreach ($request->maintenance_technician_ids as $maintenance_id){
        //     EmergencyMaintenance::create([
        //         'maintenance_technician_id' => $maintenance_id,
        //         'emergency_id' =>  $emergency->id,
        //     ]);
        // }
        return EmergencyResource::make($emergency);
    }

    public function update(UpdateEmergencyRequest $requst, Emergency $emergency) {
        $requst->validated($requst->all());
        $emergency->update($requst->all());
        return EmergencyResource::make($emergency);
    }

    public function show(Emergency $emergency) {
        return EmergencyResource::make($emergency);
    }

    public function destroy(Emergency $emergency){
        $emergency->delete();
        return $this->success($emergency,'Deleted Successfully From Our System');
    }

    function search(Request $request)
    {
        $result = Emergency::where('services', '=', $request->services)->get();
         return EmergencyResource::collection($result);
    }

}
