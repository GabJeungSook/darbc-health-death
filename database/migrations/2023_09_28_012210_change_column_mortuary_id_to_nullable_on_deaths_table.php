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
        Schema::table('deaths', function (Blueprint $table) {
            $table->foreignId('mortuary_id')->nullable()->change();
            $table->string('coverage_type')->nullable()->change();
            $table->string('amount')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deaths', function (Blueprint $table) {
            $table->foreignId('mortuary_id')->nullable(false)->change();
            $table->string('coverage_type')->nullable(false)->change();
            $table->string('amount')->nullable(false)->change();
        });
    }
};
