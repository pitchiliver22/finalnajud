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
        Schema::create('classes', function (Blueprint $table) {
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
            $table->string('time');
            $table->string('days');
            $table->string('status');
            $table->unsignedBigInteger('assign_id')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
