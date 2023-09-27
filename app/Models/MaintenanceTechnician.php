<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class MaintenanceTechnician extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory;
    protected $guarded = ['id'];
    protected $guard = 'maintenancetechnician';

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

    public function setPasswordAttribute($password){
        return $this->attributes['password'] = Hash::make($password);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
