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
        Schema::create('health_deaths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->string('batch')->nullable();
            $table->string('date')->nullable();
            $table->string('patients_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('age')->nullable();
            $table->string('enrollment_status')->nullable();
            $table->string('dhib')->nullable();
            $table->string('date_of_confinement_from')->nullable();
            $table->string('date_of_confinement_to')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('number_of_days')->nullable();
            $table->string('amount')->nullable();
            $table->string('transmittal_status')->nullable();
            $table->string('batches')->nullable();
            $table->string('transmittal_date')->nullable();
            $table->string('fortune_paid')->nullable();
            $table->string('date_of_payment')->nullable();
            $table->string('status')->nullable();
            $table->string('difference')->nullable();
            $table->string('_batches')->nullable();
            $table->string('with_hollographic-will')->nullable();
            $table->string('vehicle_cash')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('cannery')->nullable();
            $table->string('polomolok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_deaths');
    }
};
