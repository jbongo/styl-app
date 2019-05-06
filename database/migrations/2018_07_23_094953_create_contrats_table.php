<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('demarrage_starter')->default(0);
            $table->integer('id_starter')->unsigned()->nullable();
            $table->integer('id_expert')->unsigned();
            $table->integer('id_abonnement_starter')->unsigned()->nullable();
            $table->integer('id_abonnement_expert')->unsigned();
            $table->integer('id_parrainage')->unsigned();
            $table->string('numero_contrat');
            $table->integer('forfait_entree')->unsigned();
            $table->boolean('forfait_remboursable')->default(0);
            $table->integer('premiere_vente_pour_remboursement')->unsigned()->nullable();
            $table->boolean('parrain')->default(0);
            $table->integer('parrain_id')->unsigned()->nullable();
            $table->date('date_entree');
            $table->date('date_debut_activitee');
            $table->string('chemin_pdf_merge_contrat')->nullable();
            $table->string('chemin_pdf_infos')->nullable();
            $table->string('chemin_pdf_annex1')->nullable();
            $table->string('chemin_pdf_annex2')->nullable();
            $table->string('chemin_pdf_annex3')->nullable();
            $table->string('chemin_pdf_annex4')->nullable();
            $table->string('chemin_pdf_annex5')->nullable();
            $table->boolean('verif_rsac')->default(0);
            $table->double('pourcentage_actuel')->nullable();
            $table->double('chiffre_affaire_actuel')->nullable();
            $table->integer('nbr_vente_actuel')->unsigned()->nullable();
            $table->integer('nbr_filleuls_actuel')->unsigned()->nullable();
            $table->enum('role_actuel', ['starter', 'expert'])->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parrain_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('archive')->default(0);
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
        Schema::dropIfExists('contrats');
    }
}
