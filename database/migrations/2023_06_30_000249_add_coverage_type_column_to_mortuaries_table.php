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
        Schema::table('mortuaries', function (Blueprint $table) {
            $table->string('coverage_type')->after('vehicle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mortuaries', function (Blueprint $table) {
            $table->dropColumn('coverage_type');
        });
    }
};
