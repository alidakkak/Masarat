<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setImageAttribute ($image){
        $newImageName = uniqid() . '_' . 'emergency_image' . '.' . $image->extension();
        $image->move(public_path('emergency_images') , $newImageName);
        return $this->attributes['image'] =  '/'.'emergency_images'.'/' . $newImageName;
    }

    public function emergencyMaintenance() {
        return $this->hasMany(EmergencyMaintenance::class);
    }

    public function historyService() {
        return $this->hasMany(HistoryService::class);
    }


    public function callTechnician() {
        return $this->hasMany(CallTechnician::class);
    }
}
