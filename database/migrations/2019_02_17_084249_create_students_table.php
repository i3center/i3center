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
            $table->timestamps();
	        $table->string('name');
	        $table->string('national_code');
            $table->date('birth_date');
	        $table->string('father_name');
	        $table->string('username');
	        $table->string('password');
	        $table->integer('degree_id');
	        $table->string('phone_number');
	        $table->string('home_number');
	        $table->string('email');
	        $table->text('address');
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
        Schema::dropIfExists('students');
    }
}
