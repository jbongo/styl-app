<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandats', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('objet', ['mandat-recherche', 'mandat-vente']);
            $table->enum('role_mandant', ['personne_seule', 'couple', 'personne_morale', 'groupe'])->default('personne_seule');
            $table->integer('users_id')->unsigned();
            $table->integer('biens_id')->unsigned()->unique()->nullable();
            $table->integer('mandant_id')->unsigned()->nullable();
            $table->string('numero')->unique();
            $table->enum('type', ['exclusif', 'semi-exclusif','simple']);
            $table->enum('statut', ['clos', 'expiré', 'actif'])->default('actif');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->boolean('annulation')->default(0);
            $table->string('raison_annulation')->nullable();
            $table->text('note_annulation')->nullable();
            $table->text('note')->nullable();
            $table->boolean('archive')->default(0);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('biens_id')->references('id')->on('biens');
            $table->foreign('mandant_id')->references('id')->on('mandants');
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
        Schema::dropIfExists('mandats');
    }
}
