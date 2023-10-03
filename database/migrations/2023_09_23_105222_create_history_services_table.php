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
        Schema::create('history_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emergency_id')->references('id')
            ->on('emergencies')->onDelete('cascade');
            $table->string('emergency');
            $table->string('title');
            $table->string('stuts')->default('In Progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_services');
    }
};
