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
        Schema::create('previous_school', function (Blueprint $table) {

            $table->id();
            $table->string('second_school_name');
            $table->string('second_last_year_level');
            $table->string('second_school_year_from');
            $table->string('second_school_year_to');
            $table->string('second_school_type');

            $table->string('primary_school_name');
            $table->string('primary_last_year_level');
            $table->string('primary_school_year_from');
            $table->string('primary_school_year_to');
            $table->string('primary_school_type');

            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('register_form');

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previous_school');
    }
};
