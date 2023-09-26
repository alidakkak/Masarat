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
        Schema::create('call_technicians', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
        //   $table->string('Atsign to');
            $table->foreignId('maintenance_technician_id')->references('id')
            ->on('maintenance_technicians')->onDelete('cascade');
            $table->foreignId('emergency_id')->references('id')->on('emergencies')->onDelete('cascade');
            $table->double('floor_number');
            $table->string('apartment_number');
            $table->string('problems_descrption');
            $table->double('problems_evel'); 
            $table->string('stuts')->default('In Progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_technicians');
    }
};
