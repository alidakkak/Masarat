<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyMaintenance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function emergency() {
        return $this->belongsTo(Emergency::class);
    }

    public function maintenanceTechnician() {
        return $this->belongsTo(MaintenanceTechnician::class);
    }
}
