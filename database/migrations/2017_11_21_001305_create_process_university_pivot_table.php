<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessUniversityPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_university', function (Blueprint $table) {
            $table->integer('process_id')->unsigned()->index();
            $table->foreign('process_id')->references('id')->on('processes')->onDelete('cascade');
            $table->integer('university_id')->unsigned()->index();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
            $table->primary(['process_id', 'university_id']);
            $table->boolean('result');
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
        Schema::drop('process_university');
    }
}
