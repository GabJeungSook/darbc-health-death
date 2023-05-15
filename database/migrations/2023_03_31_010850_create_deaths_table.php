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
            $table->foreignId('member_id');
            $table->foreignId('mortuary_id')->index();
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
            $table->string('has_diamond_package');
            $table->date('birthday');
            $table->integer('age');
            $table->string('contact_number');
            $table->date('date_of_death');
            $table->string('place_of_death');
            $table->string('coverage_type');
            $table->string('has_vehicle');
            $table->string('amount');
            $table->integer('update_attempts')->default(0)->nullable();
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
