<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
	        $table->string('name');
            $table->string('national_code');
	        $table->text('explanation');
	        $table->integer('degree_id');
	        $table->string('phone_number');
	        $table->string('email');
	        $table->string('telegram');
            $table->string('description');
            $table->string('keywords');
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
        Schema::dropIfExists('teachers');
    }
}
