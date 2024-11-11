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
        Schema::create('studentdetails', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('suffix');
            $table->string('nationality');
            $table->string('gender');
            $table->string('civilstatus');
            $table->string('birthdate');
            $table->string('birthplace');
            $table->string('religion');
            $table->string('mother_name');
            $table->string('mother_occupation');
            $table->string('mother_contact');
            $table->string('father_name');
            $table->string('father_occupation');
            $table->string('father_contact');
            $table->string('guardian_name');
            $table->string('guardian_occupation');
            $table->string('guardian_contact');
            $table->unsignedBigInteger('details_id');
            $table->foreign('details_id')->references('id')->on('register_form');

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentdetails');
    }
};
