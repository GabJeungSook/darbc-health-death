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
        Schema::create('healths', function (Blueprint $table) {
            $table->id();
            $table->string('member_id');
            $table->foreignId('hospital_id');
            $table->integer('batch_number');
            $table->string('enrollment_status');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('contact_number');
            $table->integer('age');
            $table->date('confinement_date_from');
            $table->date('confinement_date_to');
            $table->integer('number_of_days');
            $table->integer('amount');
            $table->string('status')->nullable();
            $table->integer('update_attempts')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healths');
    }
};
