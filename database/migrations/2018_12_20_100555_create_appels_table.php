<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('biens_id')->unsigned();
            $table->enum('source', ['reseaux_sociaux', 'site_stylimmo','passerelle', 'pub_internet', 'pub_affiche', 'bouche_oreille', 'autre'])->default('autre');
            $table->integer('passerelles_id')->unsigned()->nullable();
            $table->string('nom_appelant')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('date');
            $table->text('commentaires')->nullable();
            $table->foreign('biens_id')->references('id')->on('biens');
            $table->foreign('passerelles_id')->references('id')->on('passerelles');
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
        Schema::dropIfExists('appels');
    }
}
