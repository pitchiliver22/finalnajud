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
            $table->dropColumn(['first_quarter', 'second_quarter', 'third_quarter', 'fourth_quarter']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->string('first_quarter')->nullable();
            $table->string('second_quarter')->nullable();
            $table->string('third_quarter')->nullable();
            $table->string('fourth_quarter')->nullable();
        });
    }
};
