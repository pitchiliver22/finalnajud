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
        Schema::create('core_values', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('section');
            $table->string('grade_level');
            $table->string('respect');
            $table->string('excellence');
            $table->string('teamwork');
            $table->string('innovation');
            $table->string('sustainability');
            $table->unsignedBigInteger('core_id');
            $table->foreign('core_id')->references('class_id')->on('assign');
           
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_values');
    }
};
