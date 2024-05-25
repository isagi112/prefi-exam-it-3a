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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthdate');
            $table->string('sex');
            $table->string('address');
            $table->integer('year');
            $table->string('course');
            $table->string('section');
            $table->timestamps();
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_code');
            $table->string('name');
            $table->string('description');
            $table->string('instructor');
            $table->string('schedule');
            $table->double('prelims');
            $table->double('midterms');
            $table->double('pre_finals');
            $table->double('finals');
            $table->double('average_grade');
            $table->string('remarks');
            $table->string('date_taken');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('subjects');
    }
};
