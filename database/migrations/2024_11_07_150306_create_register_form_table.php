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
        Schema::create('register_form', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->string('suffix')->nullable(); // Optional
            $table->string('email')->unique(); // Ensures no duplicate emails
            $table->string('password');
            $table->string('status');
            $table->unsignedBigInteger('user_id')->nullable(); // Add user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('register_form', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Remove foreign key constraint
            $table->dropColumn('user_id'); // Drop the column
        });
        Schema::dropIfExists('register_form');
    }


    /**
     * Reverse the migrations.
     */
};
