<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('students', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
        $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::table('universities', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });

        Schema::table('processes', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade');
        });

        Schema::table('managers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });

        Schema::table('directors', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('program_id')->references('id')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
