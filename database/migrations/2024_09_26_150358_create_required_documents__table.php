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
        Schema::create('required_documents', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('documents');
            $table->unsignedBigInteger('required_id');
            $table->timestamps();
            $table->foreign('required_id')->references('id')->on('users');

            $table->string('status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('required_documents', function (Blueprint $table) {
            $table->dropForeign(['required_id']);
        });
        Schema::dropIfExists('required_documents');
    }
};
