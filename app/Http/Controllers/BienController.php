<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photosbien;
use App\Models\Biens;
use App\Models\Passerelles;
use Illuminate\Support\Facades\Crypt;
use PDF;
use SoapBox\Formatter\Formatter;


class BienController extends Controller
{
    //
    private $photos_path;

    public function __construct()
    {
       $this->photos_path = public_path('/images/photos_bien');
    }

/**  
 * Liste des biens 
 * 
 * @author jean-philippe
 * @return \Illuminate\Http\Response
**/ 
    public function index(){

        $biens = Biens::where('user_id',auth()->id())->get();
        return view('biens.index',compact('biens'));
    }


    public function create(){
        $user = User::find(1)->get();
        return view('biens.add',compact('user'));
    }

/**   
 * Enregistrement d'un bien
 * 
 * @author jean-philippe
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
**/ 
    public function store(Request $request){
        
        // dd($request);
        // $unvalue = unserialize($value);
        //  dd($unvalue,$value);
    


        $Bien = Biens::create([
            "type_offre"=> $request['type_offre'],
            "type_bien"=> $request['type_bien'],
            "user_id"=> auth()->id(),
        ]);

        if($request['type_offre'] == "vente"){         // Vente

            if($request['type_bien'] == "maison"){

                $Bien->type_type_bien = $request['type_maison_vente_maison'];
                $Bien->titre_annonce = $request['titre_annonce_vente_maison'];
                $Bien->description_annonce = $request['description_annonce_vente_maison'];
                // $Bien->prix_public = $request['prix_public_vente_maison'];
                // $Bien->prix_privée = $request['prix_net_vendeur_vente_maison'];
                $Bien->surface_habitable = $request['surface_habitable_vente_maison'];
                $Bien->nombre_piece = $request['nb_piece_vente_maison'];
                $Bien->nombre_chambre = $request['nb_chambres_vente_maison'];
                $Bien->nombre_niveau = $request['nombre_niveau_vente_maison'];
                $Bien->jardin = $request['jardin_vente_maison'];
                $Bien->surface_jardin = $request['surface_jardin_vente_maison'];
                $Bien->privatif_jardin = $request['privatif_jardin_vente_maison'];
                $Bien->surface_terrain = $request['surface_terrain_vente_maison'];
                $Bien->piscine = $request['piscine_vente_maison'];
                $Bien->statut_piscine = $request['statut_piscine_vente_maison'];
                $Bien->nature_piscine = $request['nature_piscine_vente_maison'];
                $Bien->volume_jardin = $request['volume_piscine_vente_maison'];
                $Bien->pool_house_jardin = $request['pool_house_piscine_vente_maison'];
                $Bien->chauffee_jardin = $request['chauffee_piscine_vente_maison'];
                $Bien->couverte_jardin = $request['couverte_piscine_vente_maison'];
                $Bien->pays = $request['pays_vente_maison'];
                $Bien->ville = $request['ville_vente_maison'];
                $Bien->code_postal = $request['code_postal_vente_maison'];
                $Bien->numero_dossier = $request['numero_dossier_vente_maison'];
                $Bien->date_creation_dossier = $request['date_creation_dossier_vente_maison'];
                $Bien->nombre_garage = $request['nb_garage_vente_maison'];
                $Bien->exposition_situation = $request['exposition_situation_vente_maison'];
                $Bien->vue_situation = $request['vue_situation_vente_maison'];
                
                
            }elseif($request['type_bien'] == "appartement"){
               
                $Bien->type_type_bien = $request['type_appartement_vente_appart'];
                $Bien->titre_annonce = $request['titre_annonce_vente_appart'];
                $Bien->description_annonce = $request['description_annonce_vente_appart'];
                // $Bien->prix_public = $request['prix_public_vente_appart'];
                // $Bien->prix_privée = $request['prix_net_vendeur_vente_appart'];                
                $Bien->surface_habitable = $request['surface_habitable_vente_appart'];
                $Bien->nombre_piece = $request['nb_piece_vente_appart'];
                $Bien->nombre_chambre = $request['nb_chambres_vente_appart'];
                $Bien->nombre_niveau = $request['nombre_niveau_vente_appart'];
                $Bien->pays = $request['pays_vente_appart'];
                $Bien->ville = $request['ville_vente_appart'];
                $Bien->code_postal = $request['code_postal_vente_appart'];
                $Bien->numero_dossier = $request['numero_dossier_vente_appart'];
                $Bien->date_creation_dossier = $request['date_creation_dossier_vente_appart'];
                $Bien->nombre_garage = $request['nb_garage_vente_appart'];
                $Bien->exposition_situation = $request['exposition_situation_vente_appart'];
                $Bien->vue_situation = $request['vue_situation_vente_appart'];

            }elseif($request['type_bien'] == "terrain"){
                
                $Bien->type_type_bien = "Terrain";
                $Bien->titre_annonce = $request['titre_annonce_vente_terrain'];
                $Bien->description_annonce = $request['description_annonce_vente_terrain'];
                // $Bien->prix_public = $request['prix_public_vente_terrain'];
                // $Bien->prix_privée = $request['prix_net_vendeur_vente_terrain'];
                $Bien->surface_habitable = $request['surface_habitable_vente_terrain'];
                $Bien->pays = $request['pays_vente_terrain'];
                $Bien->ville = $request['ville_vente_terrain'];
                $Bien->code_postal = $request['code_postal_vente_terrain'];
                $Bien->numero_dossier = $request['numero_dossier_vente_terrain'];
                $Bien->date_creation_dossier = $request['date_creation_dossier_vente_terrain'];

            }elseif($request['type_bien'] == "autreType"){
         
               
                $Bien->type_type_bien = $request['type_appartement_vente_autreType'];
                $Bien->titre_annonce = $request['titre_annonce_vente_autreType'];
                $Bien->description_annonce = $request['description_annonce_vente_autreType'];
                // $Bien->prix_public = $request['prix_public_vente_autreType'];
                // $Bien->prix_privée = $request['prix_net_vendeur_vente_autreType'];
                $Bien->surface = $request['surface_vente_autreType'];
                $Bien->surface_habitable = $request['surface_habitable_vente_autreType'];
                $Bien->nombre_piece = $request['nb_piece_vente_autreType'];
                $Bien->nombre_chambre = $request['nb_chambres_vente_autreType'];
                $Bien->nombre_niveau = $request['nombre_niveau_vente_autreType'];
                $Bien->jardin = $request['jardin_vente_autreType'];
                $Bien->surface_jardin = $request['surface_jardin_vente_autreType'];
                $Bien->privatif_jardin = $request['privatif_jardin_vente_autreType'];
                $Bien->surface_terrain = $request['surface_terrain_vente_autreType'];
                $Bien->piscine = $request['piscine_vente_autreType'];
                $Bien->statut_piscine = $request['statut_piscine_vente_autreType'];
                $Bien->nature_piscine = $request['nature_piscine_vente_autreType'];

                $Bien->volume_jardin = $request['volume_piscine_vente_autreType'];
                $Bien->pool_house_jardin = $request['pool_house_piscine_vente_autreType'];
                $Bien->chauffee_jardin = $request['chauffee_piscine_vente_autreType'];
                $Bien->couverte_jardin = $request['couverte_piscine_vente_autreType'];
                $Bien->pays = $request['pays_vente_autreType'];
                $Bien->ville = $request['ville_vente_autreType'];
                $Bien->code_postal = $request['code_postal_vente_autreType'];
                $Bien->numero_dossier = $request['numero_dossier_vente_autreType'];
                $Bien->date_creation_dossier = $request['date_creation_dossier_vente_autreType'];
                $Bien->nombre_garage = $request['nb_garage_vente_autreType'];
                $Bien->exposition_situation = $request['exposition_situation_vente_autreType'];
                $Bien->vue_situation = $request['vue_situation_vente_autreType'];

            }
            else{

            }
           
        }else{ // Location
            
            if($request['type_bien'] == "maison"){

                $Bien->type_type_bien = $request['type_maison_location_maison'];
                $Bien->titre_annonce = $request['titre_annonce_location_maison'];
                $Bien->description_annonce = $request['description_annonce_location_maison'];
                $Bien->loyer = $request['loyer_location_maison'];
                $Bien->duree_bail = $request['duree_bail_location_maison'];
                $Bien->surface_habitable = $request['surface_habitable_location_maison'];
                $Bien->nombre_piece = $request['nb_piece_location_maison'];
                $Bien->nombre_chambre = $request['nb_chambres_location_maison'];
                $Bien->nombre_niveau = $request['nombre_niveau_location_maison'];
                $Bien->jardin = $request['jardin_location_maison'];
                $Bien->surface_jardin = $request['surface_jardin_location_maison'];
                $Bien->privatif_jardin = $request['privatif_jardin_location_maison'];
                $Bien->surface_terrain = $request['surface_terrain_location_maison'];
                $Bien->piscine = $request['piscine_location_maison'];
                $Bien->statut_piscine = $request['statut_piscine_location_maison'];
                $Bien->nature_piscine = $request['nature_piscine_location_maison'];
                $Bien->volume_jardin = $request['volume_piscine_location_maison'];
                $Bien->pool_house_jardin = $request['pool_house_piscine_location_maison'];
                $Bien->chauffee_jardin = $request['chauffee_piscine_location_maison'];
                $Bien->couverte_jardin = $request['couverte_piscine_location_maison'];
                $Bien->pays = $request['pays_location_maison'];
                $Bien->ville = $request['ville_location_maison'];
                $Bien->code_postal = $request['code_postal_location_maison'];
                $Bien->numero_dossier = $request['numero_dossier_location_maison'];
                $Bien->date_creation_dossier = $request['date_creation_dossier_location_maison'];
                $Bien->meuble = $request['meuble_location_maison'];
                $Bien->nombre_garage = $request['nb_garage_location_maison'];
                $Bien->exposition_situation = $request['exposition_situation_location_maison'];
                $Bien->vue_situation = $request['vue_situation_location_maison'];
                
                
            }elseif($request['type_bien'] == "appartement"){
            
                $Bien->type_type_bien = $request['type_appartement_location_appart'];
                $Bien->titre_annonce = $request['titre_annonce_location_appart'];
                $Bien->description_annonce = $request['description_annonce_location_appart'];
                $Bien->loyer = $request['loyer_location_appart'];
                $Bien->duree_bail = $request['duree_bail_location_appart'];              
                $Bien->surface_habitable = $request['surface_habitable_location_appart'];
                $Bien->nombre_piece = $request['nb_piece_location_appart'];
                $Bien->nombre_chambre = $request['nb_chambres_location_appart'];
                $Bien->nombre_niveau = $request['nombre_niveau_location_appart'];
                $Bien->pays = $request['pays_location_appart'];
                $Bien->ville = $request['ville_location_appart'];
                $Bien->code_postal = $request['code_postal_location_appart'];
                $Bien->numero_dossier = $request['numero_dossier_location_appart'];
                $Bien->date_creation_dossier = $request['date_creation_dossier_location_appart'];
                $Bien->meuble = $request['meuble_location_appart'];
                $Bien->nombre_garage = $request['nb_garage_location_appart'];
                $Bien->exposition_situation = $request['exposition_situation_location_appart'];
                $Bien->vue_situation = $request['vue_situation_location_appart'];

            }elseif($request['type_bien'] == "terrain"){
 
                $Bien->titre_annonce = $request['titre_annonce_location_terrain'];
                $Bien->description_annonce = $request['description_annonce_location_terrain'];
                $Bien->loyer = $request['loyer_location_terrain'];
                $Bien->duree_bail = $request['duree_bail_location_terrain'];
                $Bien->surface_habitable = $request['surface_habitable_location_terrain'];
                $Bien->pays = $request['pays_location_terrain'];
                $Bien->ville = $request['ville_location_terrain'];
                $Bien->code_postal = $request['code_postal_location_terrain'];
                $Bien->numero_dossier = $request['numero_dossier_location_terrain'];
                $Bien->date_creation_dossier = $request['date_creation_dossier_location_terrain'];

            }elseif($request['type_bien'] == "autreType"){

                $Bien->type_type_bien = $request['type_appartement_location_autreType'];
                $Bien->titre_annonce = $request['titre_annonce_location_autreType'];
                $Bien->description_annonce = $request['description_annonce_location_autreType'];
                $Bien->loyer = $request['loyer_location_autreType'];
                $Bien->duree_bail = $request['duree_bail_location_autreType'];
                $Bien->surface = $request['surface_location_autreType'];
                $Bien->surface_habitable = $request['surface_habitable_location_autreType'];
                $Bien->nombre_piece = $request['nb_piece_location_autreType'];
                $Bien->nombre_chambre = $request['nb_chambres_location_autreType'];
                $Bien->nombre_niveau = $request['nombre_niveau_location_autreType'];
                $Bien->jardin = $request['jardin_location_autreType'];
                $Bien->surface_jardin = $request['surface_jardin_location_autreType'];
                $Bien->privatif_jardin = $request['privatif_jardin_location_autreType'];
                $Bien->surface_terrain = $request['surface_terrain_location_autreType'];
                $Bien->piscine = $request['piscine_location_autreType'];
                $Bien->statut_piscine = $request['statut_piscine_location_autreType'];
                $Bien->nature_piscine = $request['nature_piscine_location_autreType'];
                $Bien->volume_jardin = $request['volume_piscine_location_autreType'];
                $Bien->pool_house_jardin = $request['pool_house_piscine_location_autreType'];
                $Bien->chauffee_jardin = $request['chauffee_piscine_location_autreType'];
                $Bien->couverte_jardin = $request['couverte_piscine_location_autreType'];
                $Bien->pays = $request['pays_location_autreType'];
                $Bien->ville = $request['ville_location_autreType'];
                $Bien->code_postal = $request['code_postal_location_autreType'];
                $Bien->numero_dossier = $request['numero_dossier_location_autreType'];
                $Bien->date_creation_dossier = $request['date_creation_dossier_location_autreType'];
                $Bien->meuble = $request['meuble_location_autreType'];
                $Bien->nombre_garage = $request['nb_garage_location_autreType'];
                $Bien->exposition_situation = $request['exposition_situation_location_autreType'];
                $Bien->vue_situation = $request['vue_situation_location_autreType'];

            }
            else{

            }


        }
                $Bien->titre_annonce_vitrine = $Bien->titre_annonce ;
                $Bien->description_annonce_vitrine = $Bien->description_annonce ;

                $Bien->titre_annonce_privee =  $Bien->titre_annonce ;
                $Bien->description_annonce_privee = $Bien->description_annonce ;
        
       // secteur
            // à revoir serialiser les donnees

            $section_parcelle = array(array());
            for ($i=0 ; $i < sizeof($request['section_secteurs']) ; $i++) {
                $section_parcelle[$i][0] = $request['section_secteurs'][$i] ;
                $section_parcelle[$i][1] = $request['parcelle_secteurs'][$i] ;
            }
            $Bien->section_parcelle = serialize($section_parcelle);
            // fin

        $Bien->pays_annonce_secteur = $request['pays_annonce_secteur'];
        // $Bien->code_postal_public_secteur = $request['code_postal_public_secteur'];
        // $Bien->ville_publique_secteur = $request['ville_publique_secteur'];
        // $Bien->code_postal_prive_secteur = $request['code_postal_prive_secteur'];
        // $Bien->ville_prive_secteur = $request['ville_prive_secteur'];
        $Bien->adresse_bien_secteur = $request['adresse_bien_secteur'];
        $Bien->complement_adresse_secteur = $request['complement_adresse_secteur'];
        $Bien->quartier_secteur = $request['quartier_secteur'];
        $Bien->secteur_secteur = $request['secteur_secteur'];
        $Bien->immeuble_batiment_secteur = $request['immeuble_batiment_secteur'];
        $Bien->transport_a_proximite_secteur = $request['transport_a_proximite_secteur'];
        $Bien->proximite_secteur = $request['proximite_secteur'];
        $Bien->environnement_secteur = $request['environnement_secteur'];
        
   
        //composition   à sérialiser          
        $composition_piece = array(array());
        if(isset($request['piece_compositions'])){

            for ($i=0 ; $i < sizeof($request['piece_compositions'] ); $i++) {
                
                $composition_piece[$i][0] = $request['piece_compositions'][$i] ;
                $composition_piece[$i][1] = $request['detail_piece_compositions'][$i] ;
                $composition_piece[$i][2] = $request['surface_compositions'][$i] ;
                $composition_piece[$i][3] = $request['note_compositions'][$i] ;
                $composition_piece[$i][4] = $request['etage_compositions'][$i] ;
                $composition_piece[$i][5] = $request['note_publique_compositions'][$i] ;
                $composition_piece[$i][6] = $request['note_privee_compositions'][$i] ;
                $composition_piece[$i][7] = $request['note_inter_agence_compositions'][$i] ;
            }

        $Bien->composition_piece = serialize($composition_piece);

        }
        
        
        //fin

      //détails
     
        $Bien->particularite_particularite = $request['particularite_particularite'];

        $Bien->nb_chambre_agencement_interieur = $request['nb_chambre_agencement_interieur'];
        $Bien->nb_salle_bain_agencement_interieur = $request['nb_salle_bain_agencement_interieur'];
        $Bien->nb_salle_eau_agencement_interieur = $request['nb_salle_eau_agencement_interieur'];
        $Bien->nb_wc_agencement_interieur = $request['nb_wc_agencement_interieur'];
        $Bien->nb_lot_agencement_interieur = $request['nb_lot_agencement_interieur'];
        $Bien->nb_couchage_agencement_interieur = $request['nb_couchage_agencement_interieur'];
        $Bien->nb_niveau_agencement_interieur = $request['nb_niveau_agencement_interieur'];
        $Bien->grenier_comble_agencement_interieur = $request['grenier_comble_agencement_interieur'];
        $Bien->buanderie_agencement_interieur = $request['buanderie_agencement_interieur'];
        $Bien->meuble_agencement_interieur = $request['meuble_agencement_interieur'];
        $Bien->surface_carrez_agencement_interieur = $request['surface_carrez_agencement_interieur'];
        $Bien->surface_habitable_agencement_interieur = $request['surface_habitable_agencement_interieur'];
        $Bien->surface_sejour_agencement_interieur = $request['surface_sejour_agencement_interieur'];
        $Bien->cuisine_type_agencement_interieur = $request['cuisine_type_agencement_interieur'];
        $Bien->cuisine_etat_agencement_interieur = $request['cuisine_etat_agencement_interieur'];
        $Bien->situation_exposition_agencement_interieur = $request['situation_exposition_agencement_interieur'];
        $Bien->situation_vue_agencement_interieur = $request['situation_vue_agencement_interieur'];
               
        $Bien->mitoyennete_agencement_exterieur = $request['mitoyennete_agencement_exterieur'];
        $Bien->etages_agencement_exterieur = $request['etages_agencement_exterieur'];
        $Bien->terrasse_agencement_exterieur = $request['terrasse_agencement_exterieur'];
        $Bien->nombre_terrasse_agencement_exterieur = $request['nombre_terrasse_agencement_exterieur'];
        $Bien->surface_terrasse_agencement_exterieur = $request['surface_terrasse_agencement_exterieur'];
        $Bien->plain_pied_agencement_exterieur = $request['plain_pied_agencement_exterieur'];
        $Bien->sous_sol_agencement_exterieur = $request['sous_sol_agencement_exterieur'];
        $Bien->surface_jardin_agencement_exterieur = $request['surface_jardin_agencement_exterieur'];
        $Bien->privatif_jardin_agencement_exterieur = $request['privatif_jardin_agencement_exterieur'];
        $Bien->type_cave_agencement_exterieur = $request['type_cave_agencement_exterieur'];
        $Bien->surface_cave_agencement_exterieur = $request['surface_cave_agencement_exterieur'];
        $Bien->balcon_agencement_exterieur = $request['balcon_agencement_exterieur'];
        $Bien->nb_balcon_agencement_exterieur = $request['nb_balcon_agencement_exterieur'];
        $Bien->surface_balcon_agencement_exterieur = $request['surface_balcon_agencement_exterieur'];
        $Bien->loggia_agencement_exterieur = $request['loggia_agencement_exterieur'];
        $Bien->surface_loggia_agencement_exterieur = $request['surface_loggia_agencement_exterieur'];
        $Bien->veranda_agencement_exterieur = $request['veranda_agencement_exterieur'];
        $Bien->surface_veranda_agencement_exterieur = $request['surface_veranda_agencement_exterieur'];
        $Bien->nombre_garage_agencement_exterieur = $request['nombre_garage_agencement_exterieur'];
        $Bien->surface_garage_agencement_exterieur = $request['surface_garage_agencement_exterieur'];
        $Bien->parking_interieur_agencement_exterieur = $request['parking_interieur_agencement_exterieur'];
        $Bien->parking_exterieur_agencement_exterieur = $request['parking_exterieur_agencement_exterieur'];
        $Bien->statut_piscine_agencement_exterieur = $request['statut_piscine_agencement_exterieur'];
        $Bien->dimension_piscine_agencement_exterieur = $request['dimension_piscine_agencement_exterieur'];
        $Bien->volume_piscine_agencement_exterieur = $request['volume_piscine_agencement_exterieur'];  

        $Bien->surface_terrain_terrain = $request['surface_terrain'];
        $Bien->constructible_terrain = $request['constructible_terrain'];
        $Bien->surface_constructible_terrain = $request['surface_constructible_terrain'];
        $Bien->topographie_terrain = $request['topographie_terrain'];
        $Bien->emprise_au_sol_terrain = $request['emprise_au_sol_terrain'];
        $Bien->emprise_au_sol_residuelle_terrain = $request['emprise_au_sol_residuelle_terrain'];
        $Bien->shon_terrain = $request['shon_terrain'];
        $Bien->ces_terrain = $request['ces_terrain'];
        $Bien->pos_terrain = $request['pos_terrain'];
        $Bien->codification_plu_terrain = $request['codification_plu_terrain'];
        $Bien->droit_de_passage_terrain = $request['droit_de_passage_terrain'];
        $Bien->reference_cadastrale_terrain = $request['reference_cadastrale_terrain'];
        $Bien->piscinable_terrain = $request['piscinable_terrain'];
        $Bien->arbore_terrain = $request['arbore_terrain'];
        $Bien->viabilise_terrain = $request['viabilise_terrain'];
        $Bien->cloture_terrain = $request['cloture_terrain'];
        $Bien->divisible_terrain = $request['divisible_terrain'];
        $Bien->possiblite_egout_terrain = $request['possiblite_egout_terrain'];
        $Bien->info_copopriete_terrain = $request['info_copopriete_terrain'];
        $Bien->acces_terrain = $request['acces_terrain'];
        $Bien->raccordement_eau_terrain = $request['raccordement_eau_terrain'];
        $Bien->raccordement_gaz_terrain = $request['raccordement_gaz_terrain'];
        $Bien->raccordement_electricite_terrain = $request['raccordement_electricite_terrain'];
        $Bien->raccordement_telephone_terrain = $request['raccordement_telephone_terrain'];
       
        $Bien->format_equipement = $request['format_equipement'];
        $Bien->type_equipement = $request['type_equipement'];
        $Bien->energie_equipement = $request['energie_equipement'];
        $Bien->ascenseur_equipement = $request['ascenseur_equipement'];
        $Bien->acces_handicape_equipement = $request['acces_handicape_equipement'];
        $Bien->climatisation_equipement = $request['climatisation_equipement'];
        $Bien->climatisation_specification_equipement = $request['climatisation_specification_equipement'];
        $Bien->eau_alimentation_equipement = $request['eau_alimentation_equipement'];
        $Bien->eau_assainissement_equipement = $request['eau_assainissement_equipement'];
        $Bien->eau_chaude_distribution_equipement = $request['eau_chaude_distribution_equipement'];
        $Bien->eau_chaude_energie_equipement = $request['eau_chaude_energie_equipement'];
        $Bien->cheminee_equipement = $request['cheminee_equipement'];
        $Bien->arrosage_automatique_equipement = $request['arrosage_automatique_equipement'];
        $Bien->barbecue_equipement = $request['barbecue_equipement'];
        $Bien->tennis_equipement = $request['tennis_equipement'];
        $Bien->local_a_velo_equipement = $request['local_a_velo_equipement'];
        $Bien->volet_electrique_equipement = $request['volet_electrique_equipement'];
        $Bien->gardien_equipement = $request['gardien_equipement'];
        $Bien->double_vitrage_equipement = $request['double_vitrage_equipement'];
        $Bien->triple_vitrage_equipement = $request['triple_vitrage_equipement'];
        $Bien->cable_equipement = $request['cable_equipement'];
        $Bien->securite_porte_blinde_equipement = $request['securite_porte_blinde_equipement'];
        $Bien->securite_interphone_equipement = $request['securite_interphone_equipement'];
        $Bien->securite_visiophone_equipement = $request['securite_visiophone_equipement'];
        $Bien->securite_alarme_equipement = $request['securite_alarme_equipement'];
        $Bien->securite_digicode_equipement = $request['securite_digicode_equipement'];
        $Bien->securite_detecteur_de_fumee_equipement = $request['securite_detecteur_de_fumee_equipement'];
        $Bien->portail_electrique_equipement = $request['portail_electrique_equipement'];
        $Bien->cuisine_ete_equipement = $request['cuisine_ete_equipement'];

        $Bien->annee_construction_diagnostic = $request['annee_construction_diagnostic'];
        $Bien->dpe_bien_soumi_diagnostic = $request['dpe_bien_soumi_diagnostic'];
        $Bien->dpe_vierge_diagnostic = $request['dpe_vierge_diagnostic'];
        $Bien->dpe_consommation_diagnostic = $request['dpe_consommation_diagnostic'];
        $Bien->dpe_ges_diagnostic = $request['dpe_ges_diagnostic'];
        $Bien->dpe_diagnostic = $request['dpe_diagnostic'];
        $Bien->etat_exterieur_diagnostic = $request['etat_exterieur_diagnostic'];
        $Bien->etat_interieur_diagnostic = $request['etat_interieur_diagnostic'];
        $Bien->surface_annexe_diagnostic = $request['surface_annexe_diagnostic'];
        $Bien->etat_parasitaire_diagnostic = $request['etat_parasitaire_diagnostic'];
        $Bien->etat_parasitaire_date_diagnostic = $request['etat_parasitaire_date_diagnostic'];
        $Bien->etat_parasitaire_commentaire_diagnostic = $request['etat_parasitaire_commentaire_diagnostic'];
        $Bien->amiante_diagnostic = $request['amiante_diagnostic'];
        $Bien->amiante_date_diagnostic = $request['amiante_date_diagnostic'];
        $Bien->amiante_commentaire_diagnostic = $request['amiante_commentaire_diagnostic'];
        $Bien->electrique_diagnostic = $request['electrique_diagnostic'];
        $Bien->electrique_date_diagnostic = $request['electrique_date_diagnostic'];
        $Bien->electrique_commentaire_diagnostic = $request['electrique_commentaire_diagnostic'];
        $Bien->loi_carrez_diagnostic = $request['loi_carrez_diagnostic'];
        $Bien->loi_carrez_date_diagnostic = $request['loi_carrez_date_diagnostic'];
        $Bien->loi_carrez_commentaire_diagnostic = $request['loi_carrez_commentaire_diagnostic'];
        $Bien->risque_nat_diagnostic = $request['risque_nat_diagnostic'];
        $Bien->risque_nat_date_diagnostic = $request['risque_nat_date_diagnostic'];
        $Bien->risque_nat_commentaire_diagnostic = $request['risque_nat_commentaire_diagnostic'];
        $Bien->plomb_diagnostic = $request['plomb_diagnostic'];
        $Bien->plomb_date_diagnostic = $request['plomb_date_diagnostic'];
        $Bien->plomb_commentaire_diagnostic = $request['plomb_commentaire_diagnostic'];
        $Bien->gaz_diagnostic = $request['gaz_diagnostic'];
        $Bien->gaz_date_diagnostic = $request['gaz_date_diagnostic'];
        $Bien->gaz_commentaire_diagnostic = $request['gaz_commentaire_diagnostic'];
        $Bien->assainissement_diagnostic = $request['assainissement_diagnostic'];
        $Bien->assainissement_date_diagnostic = $request['assainissement_date_diagnostic'];
        $Bien->assainissement_commentaire_diagnostic = $request['assainissement_commentaire_diagnostic'];

        $Bien->bien_en_copropriete = $request['bien_en_copropriete'];
        $Bien->numero_lot_info_copropriete = $request['numero_lot_info_copropriete'];
        $Bien->nombre_lot_info_copropriete = $request['nombre_lot_info_copropriete'];
        $Bien->quote_part_charge_info_copropriete = $request['quote_part_charge_info_copropriete'];
        $Bien->montant_fond_travaux_info_copropriete = $request['montant_fond_travaux_info_copropriete'];
        $Bien->plan_sauvegarde_info_copropriete = $request['plan_sauvegarde_info_copropriete'];
        $Bien->statut_syndic_info_copropriete = $request['statut_syndic_info_copropriete'];
        $Bien->numero_dossier_dispo = $request['numero_dossier_dispo'];
        $Bien->dossier_cree_le_dossier_dispo = $request['dossier_cree_le_dossier_dispo'];
        $Bien->disponibilite_immediate_dossier_dispo = $request['disponibilite_immediate_dossier_dispo'];
        $Bien->disponible_le_dossier_dispo = $request['disponible_le_dossier_dispo'];
        $Bien->liberation_le_dossier_dispo = $request['liberation_le_dossier_dispo'];



        $Bien->prix_prive = $request['prix_net_info_fin'];
        $Bien->prix_public = $request['prix_public_info_fin'];
        $Bien->honoraire_acquereur_info_fin = $request['honoraire_acquereur_info_fin'];
        $Bien->honoraire_vendeur_info_fin = $request['honoraire_vendeur_info_fin'];
        $Bien->estimation_date_info_fin = $request['estimation_date_info_fin'];
        $Bien->travaux_a_prevoir_info_fin = $request['travaux_a_prevoir_info_fin'];
        $Bien->depot_garanti_info_fin = $request['depot_garanti_info_fin'];
        $Bien->taxe_habitation_info_fin = $request['taxe_habitation_info_fin'];
        $Bien->taxe_fonciere_info_fin = $request['taxe_fonciere_info_fin'];
        $Bien->charge_mensuelle_total_info_fin = $request['charge_mensuelle_total_info_fin'];
        $Bien->charge_mensuelle_info_info_fin = $request['charge_mensuelle_info_info_fin'];
        

        // Sauvegarde du bien
        $Bien->update();


        $bien_id = Crypt::encrypt($Bien->id); 
        
        return redirect()->route('uptof',$bien_id);
        // dd($request);
    }
    
/**  Affichage d'un bien 
*
* @author jean-philippe
* @param  int $id
* @return \Illuminate\Http\Response
**/ 
    public function show($id){
        try {
            $bien_id = Crypt::decrypt($id);
        } catch(DecryptException $e){
            abort(404);
        }
        $bien = Biens::where('id',$bien_id)->firstorfail();
        $bien_id_crypt = $id;

        $liste_photos = Photosbien::where('biens_id',$bien_id)->orderBy('image_position','asc')->get();
       



        // dd($bien);

        return view("biens.show",compact(['bien','bien_id_crypt','liste_photos']));
    }


    ///////// ########## GESTION DES PHOTOS D'UN BIEN 

    // affichage du formulaire d'ajout des photos du bien
    public function uploadPhoto($bien_id){
    
        return view('compenents.biens.photo.add',compact('bien_id'));
    }

    // sauvegarde des photos du bien 
    public function savePhoto(Request $request,$visibilite, $bien_id){
    
        $photos = $request->file('file');
         
        
        
        if (!is_array($photos)) {
            $photos = [$photos];
        }
        
        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
            $this->photos_path .= '/'.auth()->id();
            mkdir($this->photos_path, 0777);
        }else{
            $this->photos_path .= '/'.auth()->id();
            if (!is_dir($this->photos_path)) {

                mkdir($this->photos_path, 0777);
            }
        }

        
       
            for ($i = 0; $i < count($photos); $i++) {
                $photo = $photos[$i];
                $name = sha1(date('YmdHis') .str_random(30));
                $save_name = auth()->id().'/'.$name. '.' .$photo->getClientOriginalExtension();
                $resize_name = $name. str_random(2). '.' .$photo->getClientOriginalExtension();
                
                $img = Image::make($photo)
                    ->resize(750, 550)
                     ->save($this->photos_path .'/' .$resize_name);
    
              
                $photo->move($this->photos_path, $save_name);
                
                $bienid = Crypt::decrypt($bien_id);
                
                // dans ce bloc, on réccupère la plus grande position enrégistrée et on l'incremente pour la position de l'image suivante
                $image_position = 0;
                $image_position =  Photosbien::where([
                    ['biens_id',$bienid],
                    ['visibilite',$visibilite]
                    ])->pluck('image_position')->toArray();

                if(sizeof($image_position) ==0){
                    $image_position = 1;
                }else{
                      $image_position = max($image_position ) + 1;
                }
              
                

                Photosbien::create([
                    "biens_id" => $bienid,
                    "visibilite"=> $visibilite,
                    "filename"=> $save_name,
                    "resized_name"=>auth()->id().'/'.$resize_name,
                    "original_name"=> basename($photo->getClientOriginalName()),
                    "image_position" => $image_position,

                ]);
                     //dd($photos);
            }
        return Response::json([
            'message' => 'Image sauvegardée'
        ], 200);
    }

    public function test (){

        

    }


    // liste de toutes les photos
    public function indexPhoto()
    {
        $photos = Photosbien::all();
        return view('compenents.biens.photo.index', compact('photos'));
    }



    // Suppression d'une photo pendant l'upload
    public function destroyPhoto(Request $request)
    {
        $filename = $request->id;
        $uploaded_image = Photosbien::where('original_name', basename($filename))->first();
 
        if (empty($uploaded_image)) {
            return Response::json(['message' => 'desolé cette photo n\'existe pas'], 400);
        }
 
        $file_path = $this->photos_path . '/' . $uploaded_image->filename;
        $resized_file = $this->photos_path . '/' . $uploaded_image->resized_name;
 
        if (file_exists($file_path)) {
            unlink($file_path);
        }
 
        if (file_exists($resized_file)) {
            unlink($resized_file);
        }
 
        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }
 
        return Response::json(['message' => 'Fiichier supprimé'], 200);
    }

    public function deletePhoto($id){

        $photo = Photosbien::where('id', $id)->first();
        $photo->delete();
        return back()->with('ok', __("Photo supprimée"));
    }

    public function multifileupload()
    {
        return view('dropzoneJs');
    }

/** Fonction de téléchargement des photos du bien document
* @author jean-philippe
* @param  App\Models\PhotosBien
* @return \Illuminate\Http\Response
**/ 
    public function getPhoto( $photo_id){

        $photo = PhotosBien::where('id',$photo_id)->firstorfail();
    
        $path = public_path('images\photos_bien\\'.$photo->resized_name) ;
        return response()->download($path);
    }

/** Fonction de téléchargement des photos du bien document
* @author jean-philippe
* @param  App\Models\PhotosBien
* @return \Illuminate\Http\Response
**/ 

    public function updatePhoto(Request $request){

        //    return $list_photo;
        $tab_list = json_decode($request["list"], true);
        $i = 0; 
        while($i < sizeof($tab_list)){
            $photo = PhotosBien::where('id',$tab_list[$i])->firstorfail();
            $photo->image_position = $i +1;
            $photo->update();
            $i++;
        }

        return Response::json([
            'message' => $tab_list
        ], 200);
    }


/** Fonction de mise à jour des biens
* @author jean-philippe
* @param  App\Models\Biens
* @return \Illuminate\Http\Response
**/ 

public function update(Biens $bien, Request $request){

    
    // on reccupere toutes les clés du $request
    $request_keys = array_keys($request->toArray());
       
        for ($i = 2; $i < sizeof($request_keys); $i++ ){
            
            $bien[$request_keys[$i]] = $request[$request_keys[$i]];
            
        }

        // cas particuliers avec case à cocher
        if( isset($request["dpe_bien_soumi_diagnostic"]) ){
            $bien["dpe_bien_soumi_diagnostic"] = "on";
        }else{
            $bien["dpe_bien_soumi_diagnostic"] = "off";
        }

        if( isset($request["dpe_vierge_diagnostic"]) ){
            $bien["dpe_vierge_diagnostic"] = "on";
        }else{
            $bien["dpe_vierge_diagnostic"] = "off";
        }

    
    $bien->update();
    return $request;

}

/** Fonction permettant d'imprimer une fiche de bien
* @author jean-philippe
* @param  App\Models\Biens
* @param  string type_fiche
* @param  string action
* @return \Illuminate\Http\Response
**/ 
public function impressionFiche(Biens $bien, $type_fiche, $action){

    $bien = $bien;
    // return view('compenents.biens.show.ficheVisite',compact('bien'));
    if($type_fiche == "visite"){

        $pdf = PDF::loadView('compenents.biens.show.ficheVisite',compact('bien'));
        if($action == "print"){
            return $pdf->stream('fiche_visite.pdf');
        }
        elseif($action == "download"){
            return $pdf->download('fiche_visite.pdf');
        }
    }
    elseif($type_fiche == "privee"){

        $pdf = PDF::loadView('compenents.biens.show.fichePrivee',compact('bien'));

        if($action == "print"){
            return $pdf->stream('fiche_privee.pdf');
        }
        elseif($action == "download"){
            return $pdf->download('fiche_privee.pdf');
        }
    }
       

}

/** Obtenir les passerelles d'un bien
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
public function getPasserelles(Biens $bien_id){
    
    // $passerelles =BienPasserelles::where('bien_id',$bien_id)->get();
    // dd($passerelles);
    
    $tab_passerelles = Passerelles::where('statut',1)->get()->toArray();
    $passerelles = Passerelles::where('statut',1)->get();
    
    $passerelles_bien =$bien_id->passerelles;

    $pass_list = array();
            
    foreach($passerelles as $passerelle){
        foreach($passerelle->biens as $bienp){

            if($bienp->pivot->bien_id == $bien_id->id){
                 array_push( $pass_list,$bienp->pivot->passerelle_id);
            }
           
        }
    }

    array_push($tab_passerelles,$pass_list);
  
   
    return json_encode($tab_passerelles) ;
}

}
