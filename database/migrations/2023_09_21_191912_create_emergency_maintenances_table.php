<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emergency_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emergency_id')->references('id')
             ->on('emergencies')->onDelete('cascade');
             $table->foreignId('maintenance_technician_id')->references('id')
             ->on('maintenance_technicians')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_maintenances');
    }
};
