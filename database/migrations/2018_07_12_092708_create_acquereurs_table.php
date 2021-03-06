<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcquereursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquereurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->string('type');
            


                        //personne seule
          
            $table->string('civilite')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('categorie')->nullable();
            $table->string('source_contact')->nullable();
            $table->string('telephone_fixe')->nullable();
            $table->string('telephone_mobile')->nullable();
            $table->string('email')->nullable();

            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('pays')->nullable();
            $table->string('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('langue')->nullable();
            $table->text('note')->nullable();
            // fin

            // couple
            $table->string('civilite_partenaire')->nullable();
            $table->string('nom_partenaire')->nullable();
            $table->string('prenom_partenaire')->nullable();
            $table->string('telephone_fixe_partenaire')->nullable();
            $table->string('telephone_mobile_partenaire')->nullable();
            $table->string('email_partenaire')->nullable();

            $table->string('adresse_partenaire')->nullable();
            $table->string('ville_partenaire')->nullable();
            $table->string('code_postal_partenaire')->nullable();
            $table->string('pays_partenaire')->nullable();
            $table->string('date_naissance_partenaire')->nullable();
            $table->string('lieu_naissance_partenaire')->nullable();
            $table->string('langue_partenaire')->nullable();
            $table->text('note_partenaire')->nullable();

            // Peronne morale
            $table->string('forme_juridique')->nullable();
            $table->string('raison_sociale')->nullable();
            $table->string('email_morale')->nullable();
            $table->string('adresse_morale')->nullable();
            $table->string('code_postal_morale')->nullable();
            $table->string('ville_morale')->nullable();
            $table->string('pays_morale')->nullable();
            $table->string('siret')->nullable();
            $table->string('source_contact_morale')->nullable();
            $table->text('note_morale')->nullable();
            $table->string('document_justificatif')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('serialize_doc_justificatif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acquereurs');
    }
}
