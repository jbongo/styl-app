<?php

use Illuminate\Database\Seeder;

class BiensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('biens')->delete();
        
        \DB::table('biens')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'created_at' => '2018-10-01 18:01:09',
                'updated_at' => '2018-10-01 18:01:09',
                'type_offre' => 'vente',
                'type_bien' => 'maison',
                'type_type_bien' => 'Château',
                'titre_annonce' => 'Vente d\'un chateau très beau',
                'description_annonce' => '"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor.',
                'prix_public' => 450000.0,
                'prix_prive' => 400000.0,
                'surface' => NULL,
                'surface_habitable' => 124.5,
                'nombre_piece' => 5,
                'nombre_chambre' => 3,
                'nombre_niveau' => 2,
                'jardin' => 'Oui',
                'surface_jardin' => 45.0,
                'privatif_jardin' => 'Oui',
                'surface_terrain' => 145.0,
                'piscine' => 'Oui',
                'statut_piscine' => 'Collective',
                'nature_piscine' => 'Coque',
                'volume_jardin' => 12.0,
                'pool_house_jardin' => 'Oui',
                'chauffee_jardin' => 'Non',
                'couverte_jardin' => 'Oui',
                'pays' => 'France',
                'ville' => 'nice',
                'code_postal' => '45822',
                'numero_dossier' => 'Dossier_01',
                'date_creation_dossier' => '2018-10-10',
                'nombre_garage' => 1,
                'exposition_situation' => 'Nord',
                'vue_situation' => 'Aucune',
                'loyer' => NULL,
                'duree_bail' => NULL,
                'meuble' => NULL,
                'section_parcelle' => 'a:1:{i:0;a:2:{i:0;s:6:"SecABC";i:1;s:5:"14782";}}',
                'pays_annonce_secteur' => 'Belgique',
                // 'code_postal_public_secteur' => '45228',
                // 'ville_publique_secteur' => 'Nice',
                // 'code_postal_prive_secteur' => '45002',
                // 'ville_prive_secteur' => 'Nice',
                'adresse_bien_secteur' => '7 avenue nicois',
                'complement_adresse_secteur' => 'rez de chausée',
                'quartier_secteur' => 'Gof',
                'secteur_secteur' => 'seine',
                'immeuble_batiment_secteur' => '2',
                'transport_a_proximite_secteur' => 'tram',
                'proximite_secteur' => '50 mètre',
                'environnement_secteur' => 'Calme',
                'composition_piece' => 'a:1:{i:0;a:8:{i:0;s:6:"Balcon";i:1;s:4:"2 m2";i:2;s:1:"4";i:3;s:11:"pas de note";i:4;s:1:"1";i:5;s:5:"false";i:6;s:4:"true";i:7;s:5:"false";}}',
                'particularite_particularite' => 'Investissement',
                'nb_chambre_agencement_interieur' => 2,
                'nb_salle_bain_agencement_interieur' => 1,
                'nb_salle_eau_agencement_interieur' => 1,
                'nb_wc_agencement_interieur' => 2,
                'nb_lot_agencement_interieur' => 1,
                'nb_couchage_agencement_interieur' => 2,
                'nb_niveau_agencement_interieur' => 1,
                'grenier_comble_agencement_interieur' => 'Oui',
                'buanderie_agencement_interieur' => 'Oui',
                'meuble_agencement_interieur' => 'Non',
                'surface_carrez_agencement_interieur' => 6.0,
                'surface_habitable_agencement_interieur' => 6.0,
                'surface_sejour_agencement_interieur' => 5.0,
                'cuisine_type_agencement_interieur' => 'Américaine',
                'cuisine_etat_agencement_interieur' => 'Sémi-équipée',
                'situation_exposition_agencement_interieur' => 'Est',
                'situation_vue_agencement_interieur' => NULL,
                'mitoyennete_agencement_exterieur' => '1 côté',
                'etages_agencement_exterieur' => 2,
                'terrasse_agencement_exterieur' => 'Oui',
                'nombre_terrasse_agencement_exterieur' => 1.0,
                'surface_terrasse_agencement_exterieur' => 5.0,
                'plain_pied_agencement_exterieur' => 'Oui',
                'sous_sol_agencement_exterieur' => 'Sans',
                'surface_jardin_agencement_exterieur' => '14',
                'privatif_jardin_agencement_exterieur' => 'Non précisé',
                'type_cave_agencement_exterieur' => 'Non',
                'surface_cave_agencement_exterieur' => NULL,
                'balcon_agencement_exterieur' => 'Non',
                'nb_balcon_agencement_exterieur' => NULL,
                'surface_balcon_agencement_exterieur' => NULL,
                'loggia_agencement_exterieur' => 'Non',
                'surface_loggia_agencement_exterieur' => NULL,
                'veranda_agencement_exterieur' => 'Non',
                'surface_veranda_agencement_exterieur' => NULL,
                'nombre_garage_agencement_exterieur' => 1,
                'surface_garage_agencement_exterieur' => 6.0,
                'parking_interieur_agencement_exterieur' => 1,
                'parking_exterieur_agencement_exterieur' => 0,
                'statut_piscine_agencement_exterieur' => 'Privative',
                'dimension_piscine_agencement_exterieur' => '10',
                'volume_piscine_agencement_exterieur' => 3.0,
                'surface_terrain_terrain' => 45.0,
                'surface_constructible_terrain' => 35.0,
                'constructible_terrain' => 'Oui',
                'topographie_terrain' => 'Plat',
                'emprise_au_sol_terrain' => 'no',
                'emprise_au_sol_residuelle_terrain' => NULL,
                'shon_terrain' => 'DER',
                'ces_terrain' => 'RR',
                'pos_terrain' => 'DE',
                'codification_plu_terrain' => 'DDE',
                'droit_de_passage_terrain' => 'DE',
                'reference_cadastrale_terrain' => 'DEDE',
                'piscinable_terrain' => 'Oui',
                'arbore_terrain' => 'Oui',
                'viabilise_terrain' => 'Non',
                'cloture_terrain' => 'Oui',
                'divisible_terrain' => 'Non précisé',
                'possiblite_egout_terrain' => 'Non',
                'info_copopriete_terrain' => 'Non précisé',
                'acces_terrain' => 'Oui',
                'raccordement_eau_terrain' => 'Non précisé',
                'raccordement_gaz_terrain' => 'Non précisé',
                'raccordement_electricite_terrain' => 'Oui',
                'raccordement_telephone_terrain' => 'Non',
                'format_equipement' => 'Individuel',
                'type_equipement' => 'Convecteur',
                'energie_equipement' => 'Aérothermie',
                'ascenseur_equipement' => 'Oui',
                'acces_handicape_equipement' => 'Oui',
                'climatisation_equipement' => 'Non',
                'climatisation_specification_equipement' => NULL,
                'eau_alimentation_equipement' => 'Individuel',
                'eau_assainissement_equipement' => 'Tout à l\'égout',
                'eau_chaude_distribution_equipement' => 'Individuel',
                'eau_chaude_energie_equipement' => 'Ballon électrique',
                'cheminee_equipement' => 'Non précisé',
                'arrosage_automatique_equipement' => 'Non',
                'barbecue_equipement' => 'Non',
                'tennis_equipement' => 'Oui',
                'local_a_velo_equipement' => 'Oui',
                'volet_electrique_equipement' => 'Non précisé',
                'gardien_equipement' => 'Oui',
                'double_vitrage_equipement' => 'Non',
                'triple_vitrage_equipement' => 'Oui',
                'cable_equipement' => 'Oui',
                'securite_porte_blinde_equipement' => 'Oui',
                'securite_interphone_equipement' => 'Oui',
                'securite_visiophone_equipement' => 'Non',
                'securite_alarme_equipement' => 'Non précisé',
                'securite_digicode_equipement' => 'Non',
                'securite_detecteur_de_fumee_equipement' => 'Non précisé',
                'portail_electrique_equipement' => 'Non précisé',
                'cuisine_ete_equipement' => 'Non précisé',
                'annee_construction_diagnostic' => 2001,
                'dpe_bien_soumi_diagnostic' => 'on',
                'dpe_vierge_diagnostic' => 'on',
                'dpe_consommation_diagnostic' => '45',
                'dpe_ges_diagnostic' => '47',
                'dpe_diagnostic' => '2018-10-18',
                'etat_exterieur_diagnostic' => 'Etat moyen',
                'etat_interieur_diagnostic' => 'A rafraichir',
                'surface_annexe_diagnostic' => 125.0,
                'etat_parasitaire_diagnostic' => 'Oui',
                'etat_parasitaire_date_diagnostic' => '2018-10-18',
                'etat_parasitaire_commentaire_diagnostic' => 'propre',
                'amiante_diagnostic' => 'Non',
                'amiante_date_diagnostic' => NULL,
                'amiante_commentaire_diagnostic' => NULL,
                'electrique_diagnostic' => 'Non',
                'electrique_date_diagnostic' => NULL,
                'electrique_commentaire_diagnostic' => NULL,
                'loi_carrez_diagnostic' => 'Non',
                'loi_carrez_date_diagnostic' => NULL,
                'loi_carrez_commentaire_diagnostic' => NULL,
                'risque_nat_diagnostic' => 'Non précisé',
                'risque_nat_date_diagnostic' => NULL,
                'risque_nat_commentaire_diagnostic' => NULL,
                'plomb_diagnostic' => 'Non précisé',
                'plomb_date_diagnostic' => NULL,
                'plomb_commentaire_diagnostic' => NULL,
                'gaz_diagnostic' => 'Non précisé',
                'gaz_date_diagnostic' => NULL,
                'gaz_commentaire_diagnostic' => NULL,
                'assainissement_diagnostic' => 'Non précisé',
                'assainissement_date_diagnostic' => NULL,
                'assainissement_commentaire_diagnostic' => NULL,
                'bien_en_copropriete' => 'Oui',
                'numero_lot_info_copropriete' => 145,
                'nombre_lot_info_copropriete' => 1,
                'quote_part_charge_info_copropriete' => 5.0,
                'montant_fond_travaux_info_copropriete' => 4.0,
                'plan_sauvegarde_info_copropriete' => 'Oui',
                'statut_syndic_info_copropriete' => 'Pas de Procédure en cours',
                'numero_dossier_dispo' => 'N225',
                'dossier_cree_le_dossier_dispo' => '2018-10-20',
                'disponibilite_immediate_dossier_dispo' => 'Oui',
                'disponible_le_dossier_dispo' => '2018-10-26',
                'liberation_le_dossier_dispo' => '2018-10-05',
                // 'prix_net_info_fin' => 460000.0,
                // 'prix_public_info_fin' => 410000.0,
                'honoraire_acquereur_info_fin' => 'Oui',
                'honoraire_vendeur_info_fin' => 'Non',
                'estimation_date_info_fin' => '2018-10-01',
                'estimation_valeur_info_fin' => NULL,
                'viager_valeur_info_fin' => NULL,
                'viager_rente_mensuelle_info_fin' => NULL,
                'travaux_a_prevoir_info_fin' => 'AUCUN',
                'depot_garanti_info_fin' => 12000.0,
                'taxe_habitation_info_fin' => 500.0,
                'taxe_fonciere_info_fin' => 450.0,
                'charge_mensuelle_total_info_fin' => 154.0,
                'charge_mensuelle_info_info_fin' => 'JOP',
                'mandat' => 0,
            ),
            1 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'created_at' => '2018-10-01 18:13:19',
                'updated_at' => '2018-10-01 18:13:19',
                'type_offre' => 'vente',
                'type_bien' => 'terrain',
                'type_type_bien' => NULL,
                'titre_annonce' => 'Vente de terrain en centre ville',
                'description_annonce' => '"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime place',
                'prix_public' => 145000.0,
                'prix_prive' => 112000.0,
                'surface' => NULL,
                'surface_habitable' => 75.0,
                'nombre_piece' => NULL,
                'nombre_chambre' => NULL,
                'nombre_niveau' => NULL,
                'jardin' => NULL,
                'surface_jardin' => NULL,
                'privatif_jardin' => NULL,
                'surface_terrain' => NULL,
                'piscine' => NULL,
                'statut_piscine' => NULL,
                'nature_piscine' => NULL,
                'volume_jardin' => NULL,
                'pool_house_jardin' => NULL,
                'chauffee_jardin' => NULL,
                'couverte_jardin' => NULL,
                'pays' => 'France',
                'ville' => 'Lyon',
                'code_postal' => '52440',
                'numero_dossier' => NULL,
                'date_creation_dossier' => NULL,
                'nombre_garage' => NULL,
                'exposition_situation' => NULL,
                'vue_situation' => NULL,
                'loyer' => NULL,
                'duree_bail' => NULL,
                'meuble' => NULL,
                'section_parcelle' => 'a:1:{i:0;a:2:{i:0;s:3:"DDE";i:1;s:5:"14521";}}',
                'pays_annonce_secteur' => 'France',
                // 'code_postal_public_secteur' => '55200',
                // 'ville_publique_secteur' => 'QA',
                // 'code_postal_prive_secteur' => '84000',
                // 'ville_prive_secteur' => 'DEDE',
                'adresse_bien_secteur' => 'AQSE',
                'complement_adresse_secteur' => 'DE',
                'quartier_secteur' => 'DEDE',
                'secteur_secteur' => 'JLBHKBH',
                'immeuble_batiment_secteur' => 'DE',
                'transport_a_proximite_secteur' => 'JLM',
                'proximite_secteur' => 'GY',
                'environnement_secteur' => '?J',
                'composition_piece' => 'a:1:{i:0;a:8:{i:0;s:7:"Terrain";i:1;s:4:"DEDE";i:2;s:3:"142";i:3;s:4:"DEDE";i:4;s:1:"4";i:5;s:5:"false";i:6;s:4:"true";i:7;s:5:"false";}}',
                'particularite_particularite' => 'Prestige',
                'nb_chambre_agencement_interieur' => NULL,
                'nb_salle_bain_agencement_interieur' => NULL,
                'nb_salle_eau_agencement_interieur' => NULL,
                'nb_wc_agencement_interieur' => NULL,
                'nb_lot_agencement_interieur' => NULL,
                'nb_couchage_agencement_interieur' => NULL,
                'nb_niveau_agencement_interieur' => NULL,
                'grenier_comble_agencement_interieur' => 'Non précisé',
                'buanderie_agencement_interieur' => 'Non précisé',
                'meuble_agencement_interieur' => 'Non précisé',
                'surface_carrez_agencement_interieur' => NULL,
                'surface_habitable_agencement_interieur' => NULL,
                'surface_sejour_agencement_interieur' => NULL,
                'cuisine_type_agencement_interieur' => 'Non défini',
                'cuisine_etat_agencement_interieur' => 'Non défini',
                'situation_exposition_agencement_interieur' => 'Non définie',
                'situation_vue_agencement_interieur' => NULL,
                'mitoyennete_agencement_exterieur' => 'Non précisé',
                'etages_agencement_exterieur' => NULL,
                'terrasse_agencement_exterieur' => 'Non précisé',
                'nombre_terrasse_agencement_exterieur' => NULL,
                'surface_terrasse_agencement_exterieur' => NULL,
                'plain_pied_agencement_exterieur' => 'Non précisé',
                'sous_sol_agencement_exterieur' => 'Non précisé',
                'surface_jardin_agencement_exterieur' => NULL,
                'privatif_jardin_agencement_exterieur' => 'Non précisé',
                'type_cave_agencement_exterieur' => 'Non précisé',
                'surface_cave_agencement_exterieur' => NULL,
                'balcon_agencement_exterieur' => 'Non précisé',
                'nb_balcon_agencement_exterieur' => NULL,
                'surface_balcon_agencement_exterieur' => NULL,
                'loggia_agencement_exterieur' => 'Non précisé',
                'surface_loggia_agencement_exterieur' => NULL,
                'veranda_agencement_exterieur' => 'Non précisé',
                'surface_veranda_agencement_exterieur' => NULL,
                'nombre_garage_agencement_exterieur' => NULL,
                'surface_garage_agencement_exterieur' => NULL,
                'parking_interieur_agencement_exterieur' => NULL,
                'parking_exterieur_agencement_exterieur' => NULL,
                'statut_piscine_agencement_exterieur' => 'Non défini',
                'dimension_piscine_agencement_exterieur' => NULL,
                'volume_piscine_agencement_exterieur' => NULL,
                'surface_terrain_terrain' => 75.0,
                'surface_constructible_terrain' => 55.0,
                'constructible_terrain' => 'Oui',
                'topographie_terrain' => 'Plat',
                'emprise_au_sol_terrain' => 'DDE',
                'emprise_au_sol_residuelle_terrain' => 'DE',
                'shon_terrain' => 'DE',
                'ces_terrain' => 'DE',
                'pos_terrain' => 'X',
                'codification_plu_terrain' => 'DED',
                'droit_de_passage_terrain' => 'DE',
                'reference_cadastrale_terrain' => 'DE',
                'piscinable_terrain' => 'Oui',
                'arbore_terrain' => 'Oui',
                'viabilise_terrain' => 'Oui',
                'cloture_terrain' => 'Non',
                'divisible_terrain' => 'Non précisé',
                'possiblite_egout_terrain' => 'Non précisé',
                'info_copopriete_terrain' => 'Non précisé',
                'acces_terrain' => 'Non précisé',
                'raccordement_eau_terrain' => 'Oui',
                'raccordement_gaz_terrain' => 'Non précisé',
                'raccordement_electricite_terrain' => 'Non précisé',
                'raccordement_telephone_terrain' => 'Non précisé',
                'format_equipement' => 'Non précisé',
                'type_equipement' => 'Non précisé',
                'energie_equipement' => 'Non défini',
                'ascenseur_equipement' => 'Non précisé',
                'acces_handicape_equipement' => 'Non précisé',
                'climatisation_equipement' => 'Non précisé',
                'climatisation_specification_equipement' => NULL,
                'eau_alimentation_equipement' => 'Non défini',
                'eau_assainissement_equipement' => 'Non défini',
                'eau_chaude_distribution_equipement' => 'Non défini',
                'eau_chaude_energie_equipement' => 'Non défini',
                'cheminee_equipement' => 'Non précisé',
                'arrosage_automatique_equipement' => 'Non précisé',
                'barbecue_equipement' => 'Non précisé',
                'tennis_equipement' => 'Non précisé',
                'local_a_velo_equipement' => 'Non précisé',
                'volet_electrique_equipement' => 'Non précisé',
                'gardien_equipement' => 'Non précisé',
                'double_vitrage_equipement' => 'Non précisé',
                'triple_vitrage_equipement' => 'Non précisé',
                'cable_equipement' => 'Non précisé',
                'securite_porte_blinde_equipement' => 'Non précisé',
                'securite_interphone_equipement' => 'Non précisé',
                'securite_visiophone_equipement' => 'Non précisé',
                'securite_alarme_equipement' => 'Non précisé',
                'securite_digicode_equipement' => 'Non précisé',
                'securite_detecteur_de_fumee_equipement' => 'Non précisé',
                'portail_electrique_equipement' => 'Non précisé',
                'cuisine_ete_equipement' => 'Non précisé',
                'annee_construction_diagnostic' => NULL,
                'dpe_bien_soumi_diagnostic' => NULL,
                'dpe_vierge_diagnostic' => NULL,
                'dpe_consommation_diagnostic' => NULL,
                'dpe_ges_diagnostic' => NULL,
                'dpe_diagnostic' => NULL,
                'etat_exterieur_diagnostic' => 'Non défini',
                'etat_interieur_diagnostic' => 'Non défini',
                'surface_annexe_diagnostic' => NULL,
                'etat_parasitaire_diagnostic' => 'Non précisé',
                'etat_parasitaire_date_diagnostic' => NULL,
                'etat_parasitaire_commentaire_diagnostic' => NULL,
                'amiante_diagnostic' => 'Non précisé',
                'amiante_date_diagnostic' => NULL,
                'amiante_commentaire_diagnostic' => NULL,
                'electrique_diagnostic' => 'Non précisé',
                'electrique_date_diagnostic' => NULL,
                'electrique_commentaire_diagnostic' => NULL,
                'loi_carrez_diagnostic' => 'Non précisé',
                'loi_carrez_date_diagnostic' => NULL,
                'loi_carrez_commentaire_diagnostic' => NULL,
                'risque_nat_diagnostic' => 'Non précisé',
                'risque_nat_date_diagnostic' => NULL,
                'risque_nat_commentaire_diagnostic' => NULL,
                'plomb_diagnostic' => 'Non précisé',
                'plomb_date_diagnostic' => NULL,
                'plomb_commentaire_diagnostic' => NULL,
                'gaz_diagnostic' => 'Non précisé',
                'gaz_date_diagnostic' => NULL,
                'gaz_commentaire_diagnostic' => NULL,
                'assainissement_diagnostic' => 'Non précisé',
                'assainissement_date_diagnostic' => NULL,
                'assainissement_commentaire_diagnostic' => NULL,
                'bien_en_copropriete' => 'Non précisé',
                'numero_lot_info_copropriete' => 141,
                'nombre_lot_info_copropriete' => 1475,
                'quote_part_charge_info_copropriete' => 1452.0,
                'montant_fond_travaux_info_copropriete' => 44.0,
                'plan_sauvegarde_info_copropriete' => 'Non précisé',
                'statut_syndic_info_copropriete' => 'Soumis à une procédure d\'alerte',
                'numero_dossier_dispo' => 'SEDDE',
                'dossier_cree_le_dossier_dispo' => '2018-10-19',
                'disponibilite_immediate_dossier_dispo' => 'Oui',
                'disponible_le_dossier_dispo' => '2018-10-11',
                'liberation_le_dossier_dispo' => '2018-10-19',
                // 'prix_net_info_fin' => 150000.0,
                // 'prix_public_info_fin' => 165000.0,
                'honoraire_acquereur_info_fin' => 'Oui',
                'honoraire_vendeur_info_fin' => 'Oui',
                'estimation_date_info_fin' => NULL,
                'estimation_valeur_info_fin' => NULL,
                'viager_valeur_info_fin' => NULL,
                'viager_rente_mensuelle_info_fin' => NULL,
                'travaux_a_prevoir_info_fin' => 'NON',
                'depot_garanti_info_fin' => 14.0,
                'taxe_habitation_info_fin' => 155.0,
                'taxe_fonciere_info_fin' => 25.0,
                'charge_mensuelle_total_info_fin' => 52.0,
                'charge_mensuelle_info_info_fin' => NULL,
                'mandat' => 0,
            ),
        ));
        
        
    }
}