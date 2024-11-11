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
        Schema::create('section_schedules', function (Blueprint $table) {
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_schedules');
    }
};
