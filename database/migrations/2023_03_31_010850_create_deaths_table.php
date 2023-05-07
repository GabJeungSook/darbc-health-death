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
            $table->integer('batch_number');
            $table->date('date');
            $table->string('enrollment_status');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('dependents_first_name')->nullable();
            $table->string('dependents_middle_name')->nullable();
            $table->string('dependents_last_name')->nullable();
            $table->string('dependent_type')->nullable();
            $table->boolean('has_diamond_package');
            $table->date('birthday');
            $table->integer('age');
            $table->string('contact_number');
            $table->date('date_of_death');
            $table->string('place_of_death');
            $table->string('coverage_type');
            $table->boolean('has_vehicle');
            $table->string('amount');
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
