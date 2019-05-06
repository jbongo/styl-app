<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossierVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossier_ventes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mandats_id')->unsigned()->unique();
            $table->integer('notaire_acq_id')->unsigned()->nullable();
            $table->integer('notaire_mdn_id')->unsigned()->nullable();
            $table->integer('factures_id')->unsigned()->nullable();
            $table->string('acquereurs_type')->nullable();
            $table->integer('acquereurs_id')->unsigned()->nullable();
            $table->enum('notaire_compromis', ['mandant', 'acquereur'])->default('mandant');
            $table->enum('notaire_acte', ['mandant', 'acquereur'])->default('mandant');
            $table->boolean('partenariat')->default(0);
            $table->integer('partenaire_id')->unsigned()->nullable();
            $table->double('pourcentage_partenaire')->nullable();
            $table->boolean('compromis')->default(0);
            $table->boolean('vente')->default(0);
            $table->enum('status', ['debut', 'offre', 'compromis', 'compromis_signe', 'acte_signe', 'cloture'])->default('debut');
            $table->string('numero');
            $table->date('rendez_vous_compromis')->nullable();
            $table->string('heure_compromis')->nullable();
            $table->string('adresse_compromis')->nullable();
            $table->date('rendez_vous_acte')->nullable();
            $table->string('heure_acte')->nullable();
            $table->string('adresse_acte')->nullable();
            $table->double('dossier_compromis')->nullable();
            $table->double('dossier_acte')->nullable();
            $table->double('dossier_bien')->nullable();
            $table->double('dossier_mandant')->nullable();
            $table->double('dossier_acquereur')->nullable();
            $table->text('serialize_doc_acquereur')->nullable();
            $table->text('serialize_doc_mandant')->nullable();
            $table->text('serialize_doc_bien')->nullable();
            $table->string('pdf_facture_stylimmo')->nullable();
            $table->boolean('archive')->default(0);
            // $table->foreign('mandats_id')->references('id')->on('mandats');
            // $table->foreign('offre_id')->references('id')->on('offreachats');
            // $table->foreign('notaire_mdn_id')->references('id')->on('notaire_associes');
            // $table->foreign('notaire_acq_id')->references('id')->on('notaire_associes');
            // $table->foreign('partenaire_id')->references('id')->on('users');
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
        Schema::dropIfExists('dossier_ventes');
    }
}
