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
        Schema::table('community_relations', function (Blueprint $table) {
            $table->foreignId('purpose_id')->nullable()->after('purpose');
            $table->foreignId('type_id')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_relations', function (Blueprint $table) {
            $table->dropForeign(['purpose_id']);
            $table->dropForeign(['type_id']);
            $table->dropColumn(['purpose_id', 'type_id']);
        });
    }
};
