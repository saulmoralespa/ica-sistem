<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('idPersonal')->unique();
            $table->string('phone');
            $table->string('attendant');
            $table->enum('peace_save', [
                \App\Student::ACTIVE, \App\Student::INACTIVE,
                \App\Student::DISCOUNTINUED
            ])->default(\App\Student::DISCOUNTINUED);
            $table->enum('status', [
                \App\Student::ACTIVE, \App\Student::INACTIVE,
                \App\Student::DISCOUNTINUED
            ])->default(\App\Student::INACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
