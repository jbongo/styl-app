<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->string('type_offre')->nullable();
            $table->string('type_bien')->nullable();

            //vente
            $table->string('type_type_bien')->nullable();
            $table->string('titre_annonce')->nullable();
            $table->text('prix')->nullable();
            $table->string('titre_annonce_vitrine')->nullable();
            $table->text('description_annonce_vitrine')->nullable();
            $table->string('titre_annonce_privee')->nullable();
            $table->text('description_annonce_privee')->nullable();
            $table->double('prix_public')->nullable();
            $table->double('prix_prive')->nullable();
            $table->double('surface')->nullable();
            $table->double('surface_habitable')->nullable();
            $table->integer('nombre_piece')->nullable();
            $table->integer('nombre_chambre')->nullable();
            $table->integer('nombre_niveau')->nullable();
            $table->string('jardin')->nullable();
            $table->double('surface_jardin')->nullable();
            $table->string('privatif_jardin')->nullable();
            $table->double('surface_terrain')->nullable();
            $table->string('piscine')->nullable();
            $table->string('statut_piscine')->nullable();
            $table->string('nature_piscine')->nullable();
            $table->double('volume_jardin')->nullable();
            $table->string('pool_house_jardin')->nullable();
            $table->string('chauffee_jardin')->nullable();
            $table->string('couverte_jardin')->nullable();            
            $table->string('pays')->nullable();            
            $table->string('ville')->nullable();            
            $table->string('code_postal')->nullable();            
            $table->string('numero_dossier')->nullable();            
            $table->date('date_creation_dossier')->nullable();            
            $table->integer('nombre_garage')->nullable();            
            $table->string('exposition_situation')->nullable();            
            $table->string('vue_situation')->nullable();            
            // location
            $table->double('loyer')->nullable();
            $table->integer('duree_bail')->nullable();
            $table->string('meuble')->nullable();
            //secteur
            $table->text('section_parcelle')->nullable();
            
            $table->string('pays_annonce_secteur')->nullable();
            // $table->string('code_postal_public_secteur')->nullable();
            // $table->string('ville_publique_secteur')->nullable();
            // $table->string('code_postal_prive_secteur')->nullable();
            // $table->string('ville_prive_secteur')->nullable();
            $table->string('adresse_bien_secteur')->nullable();
            $table->string('complement_adresse_secteur')->nullable();
            $table->string('quartier_secteur')->nullable();
            $table->string('secteur_secteur')->nullable();
            $table->string('immeuble_batiment_secteur')->nullable();
            $table->string('transport_a_proximite_secteur')->nullable();
            $table->string('proximite_secteur')->nullable();
            $table->string('environnement_secteur')->nullable();
            
            //composition
            $table->text('composition_piece')->nullable();            
           
            //détails
           $table->string('particularite_particularite')->nullable();    

           $table->integer('nb_chambre_agencement_interieur')->nullable();
           $table->integer('nb_salle_bain_agencement_interieur')->nullable();
           $table->integer('nb_salle_eau_agencement_interieur')->nullable();
           $table->integer('nb_wc_agencement_interieur')->nullable();
           $table->integer('nb_lot_agencement_interieur')->nullable();
           $table->integer('nb_couchage_agencement_interieur')->nullable();
           $table->integer('nb_niveau_agencement_interieur')->nullable();
           $table->string('grenier_comble_agencement_interieur')->nullable();
           $table->string('buanderie_agencement_interieur')->nullable();
           $table->string('meuble_agencement_interieur')->nullable();
           $table->double('surface_carrez_agencement_interieur')->nullable();
           $table->double('surface_habitable_agencement_interieur')->nullable();
           $table->double('surface_sejour_agencement_interieur')->nullable();
           $table->string('cuisine_type_agencement_interieur')->nullable();
           $table->string('cuisine_etat_agencement_interieur')->nullable();
           $table->string('situation_exposition_agencement_interieur')->nullable();
           $table->string('situation_vue_agencement_interieur')->nullable();
        
           $table->string('mitoyennete_agencement_exterieur')->nullable();
           $table->integer('etages_agencement_exterieur')->nullable();
           $table->string('terrasse_agencement_exterieur')->nullable();
           $table->double('nombre_terrasse_agencement_exterieur')->nullable();
           $table->double('surface_terrasse_agencement_exterieur')->nullable();
           $table->string('plain_pied_agencement_exterieur')->nullable();
           $table->string('sous_sol_agencement_exterieur')->nullable();
           $table->string('surface_jardin_agencement_exterieur')->nullable();
           $table->string('privatif_jardin_agencement_exterieur')->nullable();
           $table->string('type_cave_agencement_exterieur')->nullable();
           $table->double('surface_cave_agencement_exterieur')->nullable();
           $table->string('balcon_agencement_exterieur')->nullable();
           $table->integer('nb_balcon_agencement_exterieur')->nullable();
           $table->double('surface_balcon_agencement_exterieur')->nullable();
           $table->string('loggia_agencement_exterieur')->nullable();
           $table->double('surface_loggia_agencement_exterieur')->nullable();
           $table->string('veranda_agencement_exterieur')->nullable();
           $table->double('surface_veranda_agencement_exterieur')->nullable();
           $table->integer('nombre_garage_agencement_exterieur')->nullable();
           $table->double('surface_garage_agencement_exterieur')->nullable();
           $table->integer('parking_interieur_agencement_exterieur')->nullable();
           $table->integer('parking_exterieur_agencement_exterieur')->nullable();
           $table->string('statut_piscine_agencement_exterieur')->nullable();
           $table->string('dimension_piscine_agencement_exterieur')->nullable();
           $table->double('volume_piscine_agencement_exterieur')->nullable();

           $table->double('surface_terrain_terrain')->nullable();
           $table->double('surface_constructible_terrain')->nullable();
           $table->string('constructible_terrain')->nullable();
           $table->string('topographie_terrain')->nullable();
           $table->string('emprise_au_sol_terrain')->nullable();
           $table->string('emprise_au_sol_residuelle_terrain')->nullable();
           $table->string('shon_terrain')->nullable();
           $table->string('ces_terrain')->nullable();
           $table->string('pos_terrain')->nullable();
           $table->string('codification_plu_terrain')->nullable();
           $table->string('droit_de_passage_terrain')->nullable();
           $table->string('reference_cadastrale_terrain')->nullable();
           $table->string('piscinable_terrain')->nullable();
           $table->string('arbore_terrain')->nullable();
           $table->string('viabilise_terrain')->nullable();
           $table->string('cloture_terrain')->nullable();
           $table->string('divisible_terrain')->nullable();
           $table->string('possiblite_egout_terrain')->nullable();
           $table->string('info_copopriete_terrain')->nullable();
           $table->string('acces_terrain')->nullable();
           $table->string('raccordement_eau_terrain')->nullable();
           $table->string('raccordement_gaz_terrain')->nullable();
           $table->string('raccordement_electricite_terrain')->nullable();
           $table->string('raccordement_telephone_terrain')->nullable();

           $table->string('format_equipement')->nullable();
           $table->string('type_equipement')->nullable();
           $table->string('energie_equipement')->nullable();
           $table->string('ascenseur_equipement')->nullable();
           $table->string('acces_handicape_equipement')->nullable();
           $table->string('climatisation_equipement')->nullable();
           $table->string('climatisation_specification_equipement')->nullable();
           $table->string('eau_alimentation_equipement')->nullable();
           $table->string('eau_assainissement_equipement')->nullable();
           $table->string('eau_chaude_distribution_equipement')->nullable();
           $table->string('eau_chaude_energie_equipement')->nullable();
           $table->string('cheminee_equipement')->nullable();
           $table->string('arrosage_automatique_equipement')->nullable();
           $table->string('barbecue_equipement')->nullable();
           $table->string('tennis_equipement')->nullable();
           $table->string('local_a_velo_equipement')->nullable();
           $table->string('volet_electrique_equipement')->nullable();
           $table->string('gardien_equipement')->nullable();
           $table->string('double_vitrage_equipement')->nullable();
           $table->string('triple_vitrage_equipement')->nullable();
           $table->string('cable_equipement')->nullable();
           $table->string('securite_porte_blinde_equipement')->nullable();
           $table->string('securite_interphone_equipement')->nullable();
           $table->string('securite_visiophone_equipement')->nullable();
           $table->string('securite_alarme_equipement')->nullable();
           $table->string('securite_digicode_equipement')->nullable();
           $table->string('securite_detecteur_de_fumee_equipement')->nullable();
           $table->string('portail_electrique_equipement')->nullable();
           $table->string('cuisine_ete_equipement')->nullable();

           $table->integer('annee_construction_diagnostic')->nullable();
           $table->string('dpe_bien_soumi_diagnostic')->nullable();
           $table->string('dpe_vierge_diagnostic')->nullable();
           $table->string('dpe_consommation_diagnostic')->nullable();
           $table->string('dpe_ges_diagnostic')->nullable();
           $table->date('dpe_diagnostic')->nullable();
           $table->string('etat_exterieur_diagnostic')->nullable();
           $table->string('etat_interieur_diagnostic')->nullable();
           $table->double('surface_annexe_diagnostic')->nullable();
           $table->string('etat_parasitaire_diagnostic')->nullable();
           $table->date('etat_parasitaire_date_diagnostic')->nullable();
           $table->string('etat_parasitaire_commentaire_diagnostic')->nullable();
           $table->string('amiante_diagnostic')->nullable();
           $table->date('amiante_date_diagnostic')->nullable();
           $table->string('amiante_commentaire_diagnostic')->nullable();
           $table->string('electrique_diagnostic')->nullable();
           $table->date('electrique_date_diagnostic')->nullable();
           $table->string('electrique_commentaire_diagnostic')->nullable();
           $table->string('loi_carrez_diagnostic')->nullable(); 
           $table->date('loi_carrez_date_diagnostic')->nullable();
           $table->string('loi_carrez_commentaire_diagnostic')->nullable();
           $table->string('risque_nat_diagnostic')->nullable();
           $table->date('risque_nat_date_diagnostic')->nullable();
           $table->string('risque_nat_commentaire_diagnostic')->nullable();
           $table->string('plomb_diagnostic')->nullable(); 
           $table->date('plomb_date_diagnostic')->nullable();
           $table->string('plomb_commentaire_diagnostic')->nullable();
           $table->string('gaz_diagnostic')->nullable(); 
           $table->date('gaz_date_diagnostic')->nullable();
           $table->string('gaz_commentaire_diagnostic')->nullable();
           $table->string('assainissement_diagnostic')->nullable();
           $table->date('assainissement_date_diagnostic')->nullable();
           $table->string('assainissement_commentaire_diagnostic')->nullable();
           
           $table->string('bien_en_copropriete')->nullable();
           $table->integer('numero_lot_info_copropriete')->nullable();
           $table->integer('nombre_lot_info_copropriete')->nullable();
           $table->double('quote_part_charge_info_copropriete')->nullable();
           $table->double('montant_fond_travaux_info_copropriete')->nullable();
           $table->string('plan_sauvegarde_info_copropriete')->nullable();
           $table->string('statut_syndic_info_copropriete')->nullable();
           
           $table->string('numero_dossier_dispo')->nullable();           
           $table->date('dossier_cree_le_dossier_dispo')->nullable();           
           $table->string('disponibilite_immediate_dossier_dispo')->nullable();           
           $table->date('disponible_le_dossier_dispo')->nullable();
           $table->date('liberation_le_dossier_dispo')->nullable();        
           
        //    Prix
        //    $table->double('prix_net_info_fin')->nullable();
        //    $table->double('prix_public_info_fin')->nullable();
           $table->string('honoraire_acquereur_info_fin')->nullable();
           $table->string('honoraire_vendeur_info_fin')->nullable();
           $table->date('estimation_date_info_fin')->nullable();
           $table->double('estimation_valeur_info_fin')->nullable();
           $table->double('viager_valeur_info_fin')->nullable();
           $table->double('viager_rente_mensuelle_info_fin')->nullable();
           $table->string('travaux_a_prevoir_info_fin')->nullable();
           $table->double('depot_garanti_info_fin')->nullable();
           $table->double('taxe_habitation_info_fin')->nullable();
           $table->double('taxe_fonciere_info_fin')->nullable();
           $table->double('charge_mensuelle_total_info_fin')->nullable();
           $table->string('charge_mensuelle_info_info_fin')->nullable();
           $table->boolean('mandat')->default(0);
           $table->boolean('archive')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biens');
    }
}
