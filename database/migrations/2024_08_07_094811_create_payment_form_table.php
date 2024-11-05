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
        Schema::create('payment_form', function (Blueprint $table) {
            $table->id();
            $table->string('fee_type');
            $table->string('amount');
            $table->string('level');
            $table->string('payment_proof');
            $table->text('payment_details');
            $table->unsignedBigInteger('payment_id');

            $table->string('status')->default('pending');
            
            $table->timestamps();
            $table->foreign('payment_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_form', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
        });
        Schema::dropIfExists('payment_form');
    }
};
