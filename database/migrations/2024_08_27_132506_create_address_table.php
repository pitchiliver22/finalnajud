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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('zipcode');
            $table->string('province');
            $table->string('city');
            $table->string('barangay');
            $table->string('streetaddress');
            $table->unsignedBigInteger('address_id');
            $table->timestamps();

            $table->string('status')->default('pending');

            $table->foreign('address_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('address', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
        });
        Schema::dropIfExists('address');
    }
};
