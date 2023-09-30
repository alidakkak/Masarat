<?php

namespace App\Http\Controllers;
use App\CustomResponse\ApiResponse;
use App\Http\Requests\StoreEmergencyRequest;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\StoreMaintenanceTechnicianRequest;
use App\Http\Resources\MaintenanceTechnicianResource;
use App\Models\EmergencyMaintenance;
use Illuminate\Support\Facades\Validator;
use App\Models\HistoryService;
use App\Models\MaintenanceTechnician;
use Illuminate\Http\Request;

class MaintenanceTechnicianController extends Controller
{
    use ApiResponse;

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            //'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $guard = auth()->guard('maintenancetechnician');
        if (!$token = $guard->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    protected function createNewToken($token){
        $guard = auth()->guard('maintenancetechnician');
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $guard->factory()->getTTL() * 60,
            'user' => $guard->user()
        ]);
    }


    public function getHistory(){
        return HistoryService::with('emergency')->get();
    }

    public function recentlyAdd() {
        $recently = HistoryService::latest()->take(5)->get();
        return $recently;
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


    // public function destroy(Emergency $emergency){
    //     $emergency->delete();
    //     return $this->success($emergency,'Deleted Successfully From Our System');
    // }
}
