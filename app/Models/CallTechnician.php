<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallTechnician extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function maintenanceTechnician(){
        return $this->belongsTo(MaintenanceTechnician::class);
    }

    public function emergency(){
        return $this->belongsTo(Emergency::class);
    }


    // public function historyService(){
    //     return $this->hasMany(HistoryService::class);
    // }

    

}
