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
        Schema::create('vehicle_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('death_id');
            $table->string('schedule_first_name')->nullable();
            $table->string('schedule_middle_name')->nullable();
            $table->string('schedule_last_name')->nullable();
            $table->date('date_requested')->nullable();
            $table->date('scheduled_date')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_schedules');
    }
};
