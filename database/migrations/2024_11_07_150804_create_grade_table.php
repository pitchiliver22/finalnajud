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
        Schema::create('grade', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('section');
            $table->string('edp_code');
            $table->string('subject');
            $table->decimal('1st_quarter', 5, 2);
            $table->decimal('2nd_quarter', 5, 2);
            $table->decimal('3rd_quarter', 5, 2);
            $table->decimal('4th_quarter', 5, 2);
            $table->decimal('overall_grade', 5, 2);
            $table->string('status');
            $table->unsignedBigInteger('grade_id');
            $table->foreign('grade_id')->references('payment_id')->on('payment_form');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade');
    }
};
