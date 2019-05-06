<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('biens_id')->unsigned();
            $table->integer('appels_id')->unsigned()->nullable();
            $table->string('nom_visiteur');
            $table->string('adresse')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('ville')->nullable();
            $table->date('date_visite');
            $table->text('commentaires');
            $table->foreign('biens_id')->references('id')->on('biens');
            //$table->foreign('appels_id')->references('id')->on('appels');
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
        Schema::dropIfExists('visites');
    }
}
