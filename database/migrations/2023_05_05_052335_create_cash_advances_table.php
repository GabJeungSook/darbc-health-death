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
        Schema::create('cash_advances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->text('purpose');
            $table->text('other_purpose')->nullable();
            $table->json('contact_numbers');
            $table->string('account');
            $table->string('amount_requested');
            $table->string('amount_approved')->nullable();
            $table->date('date_received')->nullable();
            $table->date('date_approved')->nullable();
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('cash_advances');
    }
};
