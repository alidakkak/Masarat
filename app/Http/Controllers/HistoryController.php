<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryService;

class HistoryController extends Controller
{
    public function getHistory(){
        return HistoryService::with('emergency')->get();
    }

    public function recentlyAdd() {
        $recently = HistoryService::latest()->take(5)->get();
        return $recently;
    }

    public function filter(Request $request)
    {
        return HistoryService::join("emergencies", "emergencies.id", "=", "history_services.emergency_id")
            ->select(["emergencies.*", "history_services.*"])
            ->where("emergencies.services", $request->services)
            ->get();
    }
    
}
