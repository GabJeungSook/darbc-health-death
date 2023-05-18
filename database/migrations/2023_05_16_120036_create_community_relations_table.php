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
        Schema::create('community_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->string('reference_number');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('organization')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('purpose')->nullable();
            $table->string('type')->nullable();
            $table->integer('number_of_participants')->nullable();
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
        Schema::dropIfExists('community_relations');
    }
};
