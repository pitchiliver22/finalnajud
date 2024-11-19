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
        Schema::table('quarter_settings', function (Blueprint $table) {
            $table->enum('quarter_status', ['active', 'inactive'])->default('inactive')->after('fourth_quarter_enabled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quarter_settings', function (Blueprint $table) {
            $table->dropColumn('quarter_status');
        });
    }
};
