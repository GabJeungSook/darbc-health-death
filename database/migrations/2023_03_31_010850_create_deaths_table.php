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
        Schema::create('deaths', function (Blueprint $table) {
            $table->id();
            $table->string('member_id');
            $table->string('batch')->nullable();
            $table->date('date')->nullable();
            $table->string('dependents_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('age')->nullable();
            $table->string('enrollment_status')->nullable();
            $table->string('status')->nullable();
            $table->date('date_of_death')->nullable();
            $table->string('place_of_death')->nullable();
            $table->string('replacement')->nullable();
            $table->date('date_of_birth_m')->nullable();
            $table->date('date_of_birth_r')->nullable();
            $table->string('amount')->nullable();
            $table->string('transmittal_status')->nullable();
            $table->string('batches')->nullable();
            $table->string('fortune_paid')->nullable();
            $table->date('date_of_payment')->nullable();
            $table->string('remarks')->nullable();
            $table->string('difference')->nullable();
            $table->string('_batches')->nullable();
            $table->string('with_hollographic_will')->nullable();
            $table->string('vehicle_cash')->nullable();
            $table->string('vehicle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deaths');
    }
};
