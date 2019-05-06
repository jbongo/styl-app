<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('photo_profile')->nullable();
            $table->string('civilite');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('password_temporaire')->nullable();
            $table->rememberToken();
            $table->string('adresse');
            $table->string('complement_adresse')->default('Non renseigné');
            $table->integer('code_postal');
            $table->string('ville');
            $table->string('pays');
            $table->string('telephone');           
            $table->timestamps();
            $table->enum('role',['admin','prospect','prospect_plus','personnel','mandataire','intervenant','formateur'])->default('admin');
            $table->boolean('archive')->default(0);
            // complement infos
            $table->string('situation_matrimoniale')->nullable();
            $table->string('nom_jeune_fille')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('ville_naissance')->nullable();
            $table->string('pays_naissance')->nullable();
            $table->string('nationnalite')->nullable();
           
            $table->string('nom_prenom_pere')->nullable();
            $table->string('nom_prenom_mere')->nullable();
            $table->string('comment_connu_styli')->nullable();
            $table->string('ou_souhaiter_exercer')->nullable();
            $table->text('autres_infos')->nullable();

            $table->string('statut_juridique')->nullable();
            $table->string('numero_siret')->nullable();
            $table->string('numero_siren')->nullable();
            $table->string('code_caf')->nullable();
            $table->date('date_immatriculation')->nullable();

            $table->string('numero_tva')->nullable();
            $table->string('numero_rcs')->nullable();
            $table->string('nom_legal_entreprise')->nullable();

            $table->string('nom_banque')->nullable();
            $table->string('numero_compte')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();

            $table->string('numero_carte_pro')->nullable();
            $table->string('nom_detenteur_carte_pro')->nullable();
            $table->string('nom_organisme_delivrant_carte_pro')->nullable();
            $table->date('date_delivrance_carte_pro')->nullable();
            $table->string('numero_assurance')->nullable();
            $table->string('nom_organisme_assurance')->nullable();

            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->text('description')->nullable();

            $table->string('type_piece_identite')->nullable();
            $table->string('piece_identite')->nullable(); // fichier
            $table->string('livret_famille')->nullable(); // fichier
            $table->string('rib_banque')->nullable();  // fichier

            $table->string('registre_commerce_ou_attestation_immatriculation')->nullable();  // fichier
            $table->string('carte_pro')->nullable(); // fichier
            $table->string('attestation_assurance_responsabilite_civile')->nullable(); // fichier

            $table->boolean('profile_complete')->default(0);
            $table->boolean('contract_generate')->default(0);
            $table->boolean('bool_annex_5')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
