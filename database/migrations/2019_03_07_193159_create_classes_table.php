<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('course_id');
            $table->integer('teacher_id');
            $table->integer('classroom_id');
            $table->integer('capacity');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('practical_time');
            $table->time('theoretical_time');
            $table->time('term_time');
            $table->integer('state');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
