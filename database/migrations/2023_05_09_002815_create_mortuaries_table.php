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
        Schema::create('mortuaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->string('member_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('amount');
            $table->boolean('hollographic')->nullable();
            $table->string('claimants_first_name');
            $table->string('claimants_middle_name')->nullable();
            $table->string('claimants_last_name');
            $table->string('claimants_contact_number')->nullable();
            $table->date('date_received')->nullable();
            $table->string('status');
            $table->string('diamond_package');
            $table->string('vehicle')->nullable();
            $table->integer('update_attempts')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mortuaries');
    }
};
