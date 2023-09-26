<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceTechnician extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function setImageAttribute ($image){
        $newImageName = uniqid() . '_' . 'maintenance_image' . '.' . $image->extension();
        $image->move(public_path('maintenance_image') , $newImageName);
        return $this->attributes['image'] =  '/'.'maintenance_image'.'/' . $newImageName;
    }

    public function emergencyMaintenance() {
        return $this->hasMany(EmergencyMaintenance::class);
    }

    public function callTechnician() {
        return $this->hasMany(CallTechnician::class);
    }

}
