<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounselorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselors', function (Blueprint $table) {
          $table->increments('id');
          $table->string('first_name');
          $table->string('last_name');
          $table->string('email');
          $table->string('phone');
          $table->string('unit_num');
          $table->string('bsa_id');
          $table->boolean('unit_only')->default(false);
          // YPT is Youth Protection Training. Something adult leaders need.
          $table->boolean('ypt')->default(false);
          $table->integer('user_id')->unsigned()->default(null)->nullable();
          $table->integer('district_id')->unsigned()->default(null)->nullable();
          $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counselors');
    }
}
