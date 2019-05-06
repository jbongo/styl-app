<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBienPasserellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_passerelles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('bien_id')->unsigned()->index();
            $table->integer('passerelle_id')->unsigned()->index();
            $table->foreign('bien_id')->references('id')->on('biens')->onDelete('cascade');
            $table->foreign('passerelle_id')->references('id')->on('passerelles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bien_passerelles');
    }
}
