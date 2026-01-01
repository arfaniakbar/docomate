<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('evidences', function (Blueprint $table) {
            // Add foreign key columns
            $table->foreignId('project_id')->nullable()->after('user_id');
            $table->foreignId('pangwas_id')->nullable()->after('project_id');
            $table->foreignId('po_id')->nullable()->after('pangwas_id');
            $table->foreignId('tematik_id')->nullable()->after('po_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evidences', function (Blueprint $table) {
            // Drop foreign key columns
            $table->dropColumn(['project_id', 'pangwas_id', 'po_id', 'tematik_id']);
        });
    }
};
