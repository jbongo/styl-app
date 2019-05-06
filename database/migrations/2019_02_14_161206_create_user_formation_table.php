<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFormationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_formation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('formations_id')->unsigned()->index();
        //    $table->foreign('formations_id')->references('id')->on('formations');
            $table->integer('user_id')->unsigned()->index();
         //   $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_formation');
    }
}
