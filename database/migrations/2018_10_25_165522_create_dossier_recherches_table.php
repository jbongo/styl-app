<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossierRecherchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossier_recherches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mandats_id')->unsigned()->unique();
            $table->string('numero');
            $table->boolean('archive')->default(0);
            $table->foreign('mandats_id')->references('id')->on('mandats');
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
        Schema::dropIfExists('dossier_recherches');
    }
}
