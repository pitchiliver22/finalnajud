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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('section');
            $table->string('grade_level');
            $table->string('edp_code');
            $table->string('subject');
            $table->string('1st_quarter');
            $table->string('2nd_quarter');
            $table->string('3rd_quarter');
            $table->string('4th_quarter');
            $table->string('overall_attendance');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
