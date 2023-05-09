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
            $table->text('purpose');
            $table->json('contact_numbers');
            $table->string('account');
            $table->string('amount_requested');
            $table->string('amount_approved')->nullable();
            $table->date('date_received')->nullable();
            $table->date('date_approved')->nullable();
            $table->text('reason')->nullable();
            $table->string('status')->nullable();
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
