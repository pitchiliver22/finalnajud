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
        Schema::create('assign', function (Blueprint $table) {
            $table->id();
            $table->string('grade');
            $table->string('adviser');
            $table->string('section');
            $table->string('edpcode');
            $table->string('room');
            $table->string('subject');
            $table->text('description');
            $table->string('type')->nullable();
            $table->string('unit');
            $table->string('startTime');
            $table->string('endTime');
            $table->string('days');
            $table->string('status')->nullable();
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('payment_id')->on('payment_form');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign');
    }
};
