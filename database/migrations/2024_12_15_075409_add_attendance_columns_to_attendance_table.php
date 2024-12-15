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
        Schema::table('attendance', function (Blueprint $table) {
            // Check if the columns do not exist before adding them
            if (!Schema::hasColumn('attendance', 'first_quarter')) {
                $table->integer('first_quarter')->default(0);
            }
            if (!Schema::hasColumn('attendance', 'second_quarter')) {
                $table->integer('second_quarter')->default(0);
            }
            if (!Schema::hasColumn('attendance', 'third_quarter')) {
                $table->integer('third_quarter')->default(0);
            }
            if (!Schema::hasColumn('attendance', 'fourth_quarter')) {
                $table->integer('fourth_quarter')->default(0);
            }
            if (!Schema::hasColumn('attendance', 'overall_attendance')) {
                $table->integer('overall_attendance')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn(['first_quarter', 'second_quarter', 'third_quarter', 'fourth_quarter', 'overall_attendance']);
        });
    }
};
