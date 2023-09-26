<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryService extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function emergency() {
        return $this->belongsTo(Emergency::class);
    }

    // public function callTechnician() {
    //     return $this->belongsTo(CallTechnician::class);
    // }

}
