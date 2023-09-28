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
        Schema::create('death_transmittals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('death_id');
            $table->integer('batch_number');
            $table->date('date_transmitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('death_transmittals');
    }
};
