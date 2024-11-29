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
        Schema::table('core_values', function (Blueprint $table) {
      
            $table->unsignedBigInteger('core_id'); 
               $table->foreign('core_id')->references('class_id')->on('assign')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('core_values', function (Blueprint $table) {
            // Drop the columns if you need to rollback
            $table->dropForeign(['core_id']); // Drop foreign key if exists
           
        });
    }
};