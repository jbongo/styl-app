<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffreAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offre_achats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('acquereur_type');
            $table->integer('biens_id')->unsigned();
            $table->integer('mandats_id')->unsigned();
            $table->integer('acquereur_id')->unsigned();
            $table->integer('visites_id')->unsigned()->nullable();
            $table->enum('status', ['active', 'expirée', 'refusée', 'compromis']);
            $table->boolean('acceptation')->default(0);
            $table->integer('montant_offre')->unsigned();
            $table->integer('montant_commission')->unsigned();
            $table->string('charge_commission');
            $table->date('date_ajout');
            $table->date('date_fin');
            $table->text('conditions_suspensives')->nullable();
            $table->string('chemin_pdf')->nullable();
            $table->foreign('biens_id')->references('id')->on('biens');
            $table->foreign('mandats_id')->references('id')->on('mandats');
            //$table->foreign('visites_id')->references('id')->on('visites');
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
        Schema::dropIfExists('offre_achats');
    }
}
