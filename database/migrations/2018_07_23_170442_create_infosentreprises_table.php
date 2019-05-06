<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infosentreprises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('raison_sociale');
            $table->string('nom_entreprise');
            $table->string('adresse_siege_sociale');
            $table->string('nom_prenom_gerant');
            $table->integer('capital')->unsigned();
            $table->string('siret');
            $table->string('RCS');
            $table->string('TVA');
            $table->string('numero_carte_professionnelle');
            $table->date('date_delivrance');
            $table->string('organisme_delivrant');
            $table->string('nom_garant');
            $table->string('adresse_garant');
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
        Schema::dropIfExists('infosentreprises');
    }
}

