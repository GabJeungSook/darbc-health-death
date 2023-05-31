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
            $table->date('date_of_death')->nullable()->after('amount');
            $table->string('place_of_death')->nullable()->after('date_of_death');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mortuaries', function (Blueprint $table) {
            $table->dropColumn(['date_of_death', 'place_of_death']);
        });
    }
};
