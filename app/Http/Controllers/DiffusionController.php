<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passerelles;
use App\Models\Biens;
use App\Models\User;
use App\Models\BienPasserelle;
use FtpClient\FtpClient ;

class DiffusionController extends Controller
{

    private $passerelles_path;
    private $photos_path;
    
    public function __construct()	{
		$this->passerelles_path = public_path('/images/passerelles_xml');
		$this->photos_path = public_path('/images/photos_bien');
    }
    

/** Liste des passerelles 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function index_auto(){
        $passerelles = Passerelles::all();
        
        // les admins ont accès à tous les biens
        if(Auth()->user()->role== "admin"){
            $biens = Biens::all();
        }
        else{
            $biens = Biens::where('user_id',auth()->id())->get();            
        }
        
        return view('diffusion.diffusion_auto',compact(['passerelles','biens']));
    }

/** Diffusion des biens ayant des passerelles actives
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function diffuser_auto(){

        //$xml = simplexml_load_file("http://sw.ubiflow.net/types_objets.php?univers=IMMO&FILIATION=O");
        // dd($xml);
        
        //* Liste des passerelles actives
        $passerelles = Passerelles::where('statut','1')->get();

        //* Liste des id des biens à diffuser sur au moins une passerelles ($biens_id_pass)
        $biens = BienPasserelle::all()->pluck('bien_id')->toArray();        
        $biens_id_pass = array_values( array_unique($biens) );

       //* on réccupère les user_id de ces biens
        $users_id_pass = Biens::whereIn('id',$biens_id_pass)->pluck('user_id')->toArray();
        $users_id_pass = array_values( array_unique($users_id_pass) );

        //* On réccupère les users avec les id obtenus
        $users_pass = User::whereIn('id',$users_id_pass)->get();

        //* on construit un tableau contenant les users et leurs biens qui sont associé à des passerelles ($all_user_biens_pass)
        $all_user_biens_pass = array();        
        
        foreach($users_pass as $user_pass){
            $biens_pass = array();

            foreach ($user_pass->biens as $bien){
                
                if( in_array ($bien->id,  $biens_id_pass)){
                    array_push($biens_pass, array($bien, $bien->passerelles) );
                }
            }

            array_push($all_user_biens_pass, array($user_pass, $biens_pass) );
        }      
    

// *** Dans cette deuxième partie, nous allons lister par passerelle la liste des utilisateurs et leurs biens liés à cette passerelle

$big_tab = array();
        foreach($passerelles as $passerelle){

            // * on reccuepere dans $users_biens_tab les utilisateurs qui ont un bien lié à $passerelle 
            $users_biens_tab = array();
            foreach($all_user_biens_pass as $one_user_biens_pass){
                
                $biens_tab = array();
                foreach($one_user_biens_pass[1] as $bien_passerelles){
 
                    //* on reccupère les biens du user lié rattaché à la passerelle ($bien_passerelles[0] = bien et $bien_passerelles[1] = ses passerelles)
                    foreach($bien_passerelles[1] as $pass){
                        if($passerelle->reference == $pass->reference ){
                            
                            array_push($biens_tab, $bien_passerelles[0]);
                        }
                    }
                  
                     
                }
                   if( !empty($biens_tab))
                    array_push($users_biens_tab, array($biens_tab[0]->user, $biens_tab ));

           }

            if( !empty($users_biens_tab))
             array_push($big_tab, array($passerelle->reference, $users_biens_tab) );
        }


// dd($big_tab);



        //* on export les biens sur chaque passerelle active
        foreach($big_tab as $tab){

            // tab[1] = liste des users et leurs biens
            if(sizeof($tab[1]) > 0){

           
                switch($tab[0]){

                    
                    case "leboncoin" : 
                        $this->exportLeboncoin($tab[1]);
                        break;

                    case "logicimmo" : 
                        $this->exportLogicImmo($tab[1]);
                    
                        break;

                    case "clemidi" :                 
                        $this->exportCleMidi($tab[1]);

                        break;

                    case "greenacres" :                 
                        $this->exportGreenAcres($tab[1]);
                        break;
                    case "stylimmo" : 
                        $this->exportStylimmo($tab[1]);
                        break;
                    case "seloger" : 
                        $this->exportSeLoger($tab[1]);
                        break;
                    case "paruvendu" : 
                        $this->exportParuvendu($tab[1]);
                        break;
                    case "prestigeBD" : 
                        $this->exportPrestigeBelleDemeurre($tab[1]);
                        break;
                } 
            }
        }
        
    }






   ############# FONCTIONS D'EXPORT SUR CHAQUE PASSERELLE ###############
   #                                                                    #
   ######################################################################


    public function add_element($xw,$tag,$value){
            
        xmlwriter_start_element($xw, $tag);
            xmlwriter_text($xw, $value);
        xmlwriter_end_element($xw);
    }

    public function add_element_cdata($xw,$tag,$value){
            
        xmlwriter_start_element($xw, $tag);
            xmlwriter_start_cdata($xw);
                xmlwriter_text($xw, $value);
            xmlwriter_end_cdata($xw);
        xmlwriter_end_element($xw);
    }

    public function exportPrincipal(){
        

    }


/** xxxxxxxxxxxxxxx
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function exportLogicImmo($biens){
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'UTF-8');   
       
    foreach($biens as $bien){  
    xmlwriter_start_element($xw,"biens");

    //   dd($bien);

            xmlwriter_start_element($xw,"annonceur");
                $this->add_element($xw,"numero_carte_pro",$bien[0]->numero_carte_pro);
                $this->add_element($xw,"bareme_honoraires_pdf","http://stylimmo.com/bareme.php");
            xmlwriter_end_element($xw);
            //Biens à la vente
            foreach($bien[1] as $bienn){ 
            xmlwriter_start_element($xw,"bien");
                $this->add_element($xw,"agence_nom",$bien[0]->nom_legal_entreprise);
                $this->add_element($xw,"agence_tel",$bien[0]->telephone);
                $this->add_element($xw,"agence_tel2","");
                $this->add_element($xw,"agence_mail",$bien[0]->email);
                $this->add_element($xw,"agence_mobile","");
                $this->add_element($xw,"agence_fax","");
                $this->add_element($xw,"agence_adresse",$bien[0]->adresse);
                $this->add_element($xw,"agence_postal",$bien[0]->code_postal);
                $this->add_element($xw,"agence_postal_insee","");
                $this->add_element($xw,"agence_ville",$bien[0]->ville);
                $this->add_element($xw,"agence_pays",$bien[0]->pays);
                $this->add_element($xw,"code_passerelle","agent".$bien[0]->id); // a revoir
                $this->add_element($xw,"reference_logiciel", $bienn->id."_".$bienn->numero_dossier ) ; // doit être unique
                $this->add_element($xw,"reference_client",$bienn->id."_".$bienn->numero_dossier);
                $this->add_element($xw,"numero_mandat",( isset ($bienn->mandat_ok) ? $bienn->mandat_ok->numero : ""));
                $this->add_element($xw,"type_mandat",( isset ($bienn->mandat_ok) ? $bienn->mandat_ok->type : ""));
                $this->add_element($xw,"agence_tel_a_afficher",$bienn->telephone);
                $this->add_element($xw,"agence_mail_a_afficher",$bienn->email);
                xmlwriter_start_element($xw,"photos");
                foreach ($bienn->photosbiens as $photo){ 
                    xmlwriter_start_element($xw,"photo");
                        $this->add_element($xw,"titre","");
                        $this->add_element($xw,"url",$this->photos_path."/".$photo->filename);
                    xmlwriter_end_element($xw);
                }           
                xmlwriter_end_element($xw);
                $this->add_element($xw,"type_transaction",$bienn->type_offre);
                $this->add_element($xw,"type_bien",$bienn->type_type_bien);                
                xmlwriter_start_element($xw,"titres");
                    $this->add_element($xw,"titre_web_fr",$bienn->titre_annonce);
                    $this->add_element($xw,"titre_print_fr",$bienn->titre_annonce);                   
                xmlwriter_end_element($xw);
                xmlwriter_start_element($xw,"descriptions");
                    $this->add_element($xw,"descriptif_web_fr",$bienn->description_annonce);
                    $this->add_element($xw,"descriptif_print_fr",$bienn->description_annonce);
                xmlwriter_end_element($xw);
                $this->add_element($xw,"adresse",$bienn->adresse);
                $this->add_element($xw,"code_postal_a_afficher",$bienn->code_postal);
                $this->add_element($xw,"code_postal_reel",$bienn->code_postal);
                $this->add_element($xw,"code_postal_insee","");
                $this->add_element($xw,"commune_reel",$bienn->ville);
                $this->add_element($xw,"commune_a_afficher",$bienn->ville);
                $this->add_element($xw,"secteur",$bienn->secteur_secteur);
                $this->add_element($xw,"pays",$bienn->pays);
            
                $this->add_element($xw,"prix",$bienn->prix_public);
                $this->add_element($xw,"depot_garantie",$bienn->depot_garanti_info_fin);
                $this->add_element($xw,"montant_charge",""); // montant charges
                $this->add_element($xw,"montant_charges_copropriete",$bienn->quote_part_charge_info_copropriete);
                $this->add_element($xw,"frais_agence_a_la_charge_de",""); // revoir 
                $this->add_element($xw,"dpe_valeur",$bienn->dpe_ges_diagnostic);
                $this->add_element($xw,"ges_valeur",$bienn->dpe_consommation_diagnostic);
                $this->add_element($xw,"nb_pieces",$bienn->nombre_piece);
                $this->add_element($xw,"nb_chambres",$bienn->nombre_chambre);
                $this->add_element($xw,"nb_etages",$bienn->nombre_niveau);
                $this->add_element($xw,"nb_salle_d_eau",$bienn->nb_salle_eau_agencement_interieur);
                $this->add_element($xw,"nb_salle_de_bain",$bienn->nb_salle_bain_agencement_interieur);
                $this->add_element($xw,"nb_garages",$bienn->nombre_garage);
                $this->add_element($xw,"nb_parkings_exterieurs",$bienn->parking_interieur_agencement_exterieur);
                $this->add_element($xw,"nb_parkings_interieurs",$bienn->parking_exterieur_agencement_exterieur);
                $this->add_element($xw,"nb_wc",$bienn->nb_wc_agencement_interieur);
                $this->add_element($xw,"surface_bien",$bienn->surface);
                $this->add_element($xw,"surface_sejour",$bienn->surface_sejour_agencement_interieur);
                $this->add_element($xw,"surface_terrain",$bienn->surface_terrain);
                $this->add_element($xw,"annee_construction",$bienn->annee_construction_diagnostic);
                $this->add_element($xw,"pourcentage_honoraires_acquereur","");
                $this->add_element($xw,"prix_sans_honoraires",$bienn->prix_prive);                   
           

                // differences entre vente et location
                if($bienn->type_offre == "location"){

                $this->add_element($xw,"montant_frais_agence","");
                $this->add_element($xw,"montant_honoraires_etat_lieux","");
                $this->add_element($xw,"type_regularisation_charges","");
                $this->add_element($xw,"mode_regularisation_charges","");
                $this->add_element($xw,"montant_complement_loyer","");
                $this->add_element($xw,"frequence_reglement_loyer","");
                $this->add_element($xw,"frequence_reglement_charges","");
                $this->add_element($xw,"echeance_reglement_loyer","");
                $this->add_element($xw,"echeance_reglement_charges","");
                }
                
                // fin differences entre vente et location      
                
            xmlwriter_end_element($xw);
            }
         
        xmlwriter_end_element($xw); 
        }
        //Fin  du document
    xmlwriter_end_document($xw);
        file_put_contents ($this->passerelles_path.'/logicimmo.xml',xmlwriter_output_memory($xw));
    // dd( xmlwriter_output_memory($xw) );
    }


    public function code_type_leboncoin($type_bien){

        $code_lib = array();
        
        return $code_lib ;
    }


    /** Fonction de xxxxxxxxxxxxxx
    * @author jean-philippe
    * @param  App\Models\PhotosBien
    * @return \Illuminate\Http\Response
    **/	
    public function exportCleMidi($users_biens){
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
    foreach($users_biens as $user_biens){ 
    //    dd($user_biens);
        xmlwriter_start_element($xw,"Agence");
            xmlwriter_start_element($xw,"Client");
                
                xmlwriter_start_element($xw,"ClientDetails");
                    $this->add_element($xw,"clientNom",$user_biens[0]->nom_legal_entreprise);
                    $this->add_element($xw,"clientContact",$user_biens[0]->telephone);
                    $this->add_element($xw,"clientContactEmail",$user_biens[0]->email);
                    $this->add_element($xw,"clientTelephone",$user_biens[0]->telephone);
                xmlwriter_end_element($xw);
            
                xmlwriter_start_element($xw,"Annonces");

                foreach($user_biens[1] as $bien){
                    xmlwriter_start_element($xw,"Annonce");
                        $this->add_element($xw,"referenceInterne",$bien->numero_dossier);
                        $this->add_element($xw,"referenceMandat",( isset ($bien->mandat_ok) ? $bien->mandat_ok->numero : "") );
                        $this->add_element($xw,"departementNum", substr($bien->code_postal,0,2));
                        $this->add_element($xw,"codePostal",$bien->code_postal);
                        $this->add_element($xw,"codeInsee","");
                        $this->add_element($xw,"typeTransaction",$bien->type_offre);
                        $this->add_element($xw,"honoraires_charges", ($bien->honoraire_acquereur_info_fin == "Oui" ? 1 : 2) ) ;
                        $this->add_element($xw,"typeBien",$bien->type_bien);
                        $this->add_element($xw,"typePrecis",$bien->type_type_bien);
                        $this->add_element($xw,"ville", $bien->ville);
                        $this->add_element($xw,"prix", $bien->prix_public);
                        $this->add_element($xw,"prix_net",$bien->prix_prive);
                        $this->add_element($xw,"exclusivite",( isset ($bien->mandat_ok) ? $bien->mandat_ok->type : ""));
                        $this->add_element($xw,"surface",$bien->surface);
                        $this->add_element($xw,"surfaceTerrain",$bien->surface_terrain);
                        $this->add_element($xw,"nombrePiece",$bien->nombre_piece);
                        $this->add_element($xw,"nombreEtages",$bien->etages_agencement_exterieur);
                        $this->add_element($xw,"niveauEtage",$bien->nombre_niveau);
                        $this->add_element($xw,"nombreChambre",$bien->nombre_chambre);
                        $this->add_element($xw,"NombreSalleDeBain",$bien->nb_salle_bain_agencement_interieur);
                        $this->add_element($xw,"nombreSalleDeau",$bien->nb_salle_eau_agencement_interieur);
                        $this->add_element($xw,"ascenseur",$bien->ascenseur_equipement);
                        $this->add_element($xw,"accesHandicape",$bien->acces_handicape_equipement);
                        $this->add_element($xw,"surfaceBalcon",$bien->surface_balcon_agencement_exterieur);
                        $this->add_element($xw,"nombreBalcon",$bien->nb_balcon_agencement_exterieur);
                        $this->add_element($xw,"nombreTerrasse",$bien->nombre_terrasse_agencement_exterieur);
                        $this->add_element($xw,"surfaceTerrasse",$bien->surface_terrasse_agencement_exterieur);
                        $this->add_element($xw,"piscine",$bien->piscine);
                        $this->add_element($xw,"cuisine","");
                        $this->add_element($xw,"garage", ($bien->nombre_garage > 0 ? "Oui" : "Non"));
                        $this->add_element($xw,"parking","");
                        xmlwriter_start_element($xw,"dpe");
                            $this->add_element($xw,"ges",$bien->dpe_ges_diagnostic);
                            $this->add_element($xw,"bges","");
                            $this->add_element($xw,"ce",$bien->dpe_consommation_diagnostic);
                            $this->add_element($xw,"bce","");
                        xmlwriter_end_element($xw);
                        $this->add_element($xw,"titre",$bien->titre_annonce);
                        $this->add_element($xw,"descriptiff",$bien->description_annonce);
                        $this->add_element($xw,"descriptif_en","");
                        $this->add_element($xw,"descriptif_de","");	
                        				
                        xmlwriter_start_element($xw,"images");

                        foreach ($bien->photosbiens as $photo){  
                            if($photo->visibilite =="visible"){
                        
                            xmlwriter_start_element($xw,"image");
                                xmlwriter_start_attribute($xw,"number");                        
                                    xmlwriter_text($xw, $photo->image_position);
                                xmlwriter_end_attribute($xw);  
                                xmlwriter_text($xw, url('/')."/images/photos_bien/".$photo->filename);
                            xmlwriter_end_element($xw);
                            }
                        }
                        xmlwriter_end_element($xw);

                        $this->add_element($xw,"datemaj","02/12/2018"); // A revoir
                        xmlwriter_end_element($xw);			   
                    xmlwriter_end_element($xw);
                }
            xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);
  
        //Fin  du document
    xmlwriter_end_document($xw);  
    }
        file_put_contents ($this->passerelles_path.'/clemidi.xml',xmlwriter_output_memory($xw));
    // dd( xmlwriter_output_memory($xw) );
    }






    /** Fonction xxxxxxxxxxxxxxxx
    * @author jean-philippe
    * @param  App\Models\PhotosBien
    * @return \Illuminate\Http\Response
    **/	
    public function exportLeboncoin($users_biens){

        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'UTF-8'); 
    
    
     foreach($users_biens as $user_biens){

   
        xmlwriter_start_element($xw,"client");
                xmlwriter_start_attribute($xw,"code");                        
                                xmlwriter_text($xw, "ag".$user_biens[0]->id);
                xmlwriter_end_attribute($xw);
                
                xmlwriter_start_element($xw,"coordonnees");
                    $this->add_element($xw,"raison_sociale",$user_biens[0]->nom_legal_entreprise); 
                    xmlwriter_start_element($xw,"adresse"); 
                        $this->add_element($xw,"voirie",$user_biens[0]->adresse);					
                        $this->add_element($xw,"code_postal",$user_biens[0]->code_postal);					
                        $this->add_element($xw,"ville",$user_biens[0]->ville);					
                    xmlwriter_end_element($xw);	
                        
                    $this->add_element($xw,"telephone",$user_biens[0]->telephone); 					
                    $this->add_element($xw,"fax","");					
                    $this->add_element($xw,"email",$user_biens[0]->email);					
                    $this->add_element($xw,"web","");					
                xmlwriter_end_element($xw);
             
            foreach($user_biens[1] as $bien){
                //   dd($bien->mandat_ok);
                 $type = ($bien->type_offre == "vente") ? "V" : "L";
                
                xmlwriter_start_element($xw,"annonces");
                    xmlwriter_start_attribute($xw,"id");                        
                        xmlwriter_text($xw, "annonce_".$bien->id);
                    xmlwriter_end_attribute($xw); 
                    $this->add_element($xw,"reference",$bien->numero_dossier);					
                    $this->add_element($xw,"titre",$bien->titre_annonce);					
                    $this->add_element($xw,"texte",$bien->description_annonce);					
                    $this->add_element($xw,"date_saisie",$bien->created_at);					
                    $this->add_element($xw,"date_integration",$bien->created_at);
                    
                    xmlwriter_start_element($xw,"bien");

                        $this->add_element($xw,"code_type",$this->code_type($bien->type_type_bien)[0]);
                        $this->add_element($xw,"libelle_type",$this->code_type($bien->type_type_bien)[1]); 
                        $this->add_element($xw,"code_postal",$bien->code_postal); 
                        $this->add_element($xw,"ville",$bien->ville); 
                        $this->add_element($xw,"code_insee",true); 
                        $this->add_element($xw,"departement",""); 
                        $this->add_element($xw,"pays",$bien->pays); 
                        
                        $code_type = $this->code_type($bien->type_type_bien)[0]; 

                        $this->add_element($xw,"surface",($code_type == 1300 ? $bien->surface_terrain_terrain :$bien->surface) );

                        // appart
                        if($code_type >= 1100 && $code_type < 1200 ){
                            $this->add_element($xw,"etage",$bien->etages_agencement_exterieur);
                        }
                        // maison
                        if($code_type >= 1200 && $code_type < 1300 ){
                            $this->add_element($xw,"garage", ($bien->nombre_garage > 1 ? true:false) );
                            $this->add_element($xw,"surface_terrain",$bien->surface_terrain);
                            $this->add_element($xw,"nb_niveaux",$bien->nombre_niveau);
                            $this->add_element($xw,"places_garages",$bien->nombre_garage);
                        }
                        
                        // appart && maison
                        if($code_type >= 1100 && $code_type < 1300 ){
                            $this->add_element($xw,"nb_pieces",$bien->nombre_piece);
                            $this->add_element($xw,"nb_chambres",$bien->nombre_chambre);
                            $this->add_element($xw,"annee_construction",$bien->annee_construction_diagnostic);
                            $this->add_element($xw,"nb_salles_de_bain",$bien->nb_salle_bain_agencement_interieur);
                            $this->add_element($xw,"nb_salles_d_eau",$bien->nb_salle_eau_agencement_interieur);
                            $this->add_element($xw,"nb_wc",$bien->nb_wc_agencement_interieur);

                        }
                            
                    xmlwriter_end_element($xw);                    
 
                    xmlwriter_start_element($xw,"diagnostiques");
                        $this->add_element($xw,"dpe_valeur_ges",$bien->dpe_ges_diagnostic  );
                        $this->add_element($xw,"dpe_valeur_conso",$bien->dpe_consommation_diagnostic);
                    xmlwriter_end_element($xw);	

                    xmlwriter_start_element($xw,"prestation");
                   
                        $this->add_element($xw,"type", $type );
                        if(isset($bien->mandat_ok)){
                            $this->add_element($xw,"mandat_type",$bien->mandat_ok->type); 
                            $this->add_element($xw,"mandat_numero",$bien->mandat_ok->numero); 
                        }
                       
                        if($type == "L"){
                            $this->add_element($xw,"complement_loyer","" ); // revoir
                            $this->add_element($xw,"modalites_recuperation_charges_locatives","");// revoir
                            $this->add_element($xw,"loyer_mensuel_cc",$bien->loyer );
                            $this->add_element($xw,"honoraires_etat_des_lieux","");// revoir
                           
                        }
                        if($type=="V"){
                            $this->add_element($xw,"prix",$bien->prix_public);  // revoir prix total et TTC
                            $this->add_element($xw,"honoraires_payeurs",($bien->honoraire_acquereur_info_fin == "Oui") ? "acquéreur" : "vendeur" );
                            $this->add_element($xw,"prix_hors_honoraires", $bien->prix_public );// revoir
                            $this->add_element($xw,"honoraires_charge_vendeur",($bien->honoraire_vendeur_info_fin == "Oui") ? true : false );
                            $this->add_element($xw,"honoraires_charge_acquereur",($bien->honoraire_acquereur_info_fin == "Oui") ? true : false );
                            $this->add_element($xw,"pourcentage_honoraires_vendeur","" );// revoir
                            $this->add_element($xw,"pourcentage_honoraires_acquereur","" );// revoir
                        }
                        // dd($bien->photosbiens);
                    xmlwriter_end_element($xw);	
                    xmlwriter_start_element($xw,"photos");
                        foreach ($bien->photosbiens as $photo){  
                            if($photo->visibilite =="visible"){
                                $this->add_element($xw,"photo", url('/')."/images/photos_bien/".$photo->filename);
                            }
                        }                     
                    xmlwriter_end_element($xw);	
                        $this->add_element($xw,"contact_a_afficher","Styl'immo");                                          
                        $this->add_element($xw,"email_a_afficher","stylgroupe@orange.fr");   // **** recupperer dans les params de l'appli                                       
                        $this->add_element($xw,"telephone_a_afficher",$user_biens[0]->telephone);                                          
                    xmlwriter_end_element($xw);
            }

   
        //Fin  du document
    xmlwriter_end_document($xw); 
    }
        file_put_contents ($this->passerelles_path.'/leboncoin.xml',xmlwriter_output_memory($xw));
    // dd( xmlwriter_output_memory($xw) );
    }


    /** Fonction d'export pour Greenacres/immofrance
    * @author jean-philippe
    * @param  App\Models\PhotosBien
    * @return \Illuminate\Http\Response
    **/	
    public function exportGreenAcres($users_biens){
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
   
    //    dd($user_biens);
        xmlwriter_start_element($xw,"Envelope");
            xmlwriter_start_element($xw,"Body");
                xmlwriter_start_element($xw,"add_adverts");

                foreach($users_biens as $user_biens){ 

                    foreach($user_biens[1] as $bien){
                        $type_bien = "";

                        if($bien->type_bien == "maison"){  $type_bien = "house";}
                        elseif($bien->type_bien == "appartement"){  $type_bien = "appartement";}
                        elseif($bien->type_bien == "terrain"){  $type_bien = "land";}
                        else{  $type_bien = "parking";}
                        
                    xmlwriter_start_element($xw,"advert");

                        $this->add_element($xw,"account_id","192603");  // *** num client statique
                        $this->add_element($xw,"reference","192603-".( isset ($bien->mandat_ok) ? $bien->mandat_ok->numero : ""));
                        $this->add_element($xw,"advert_type",(($bien->type_offre == "location") ? "rentals" : "properties"));
                        $this->add_element($xw,"price", (($bien->type_offre == "location") ? $bien->loyer : $bien->prix_public) );
                        $this->add_element($xw,"has_included_fees",""); //*** revoir
                        $this->add_element($xw,"agency_rates_type", (($bien->honoraire_acquereur_info_fin == "Oui") ? "1" : "0" )); //**revoir */
                        $this->add_element($xw,"agency_rates",""); //*** revoir
                        $this->add_element($xw,"fees",""); //**** revoir frais agences */
                        $this->add_element($xw,"agency_rate_scale_url","http://www.stylimmo.com/bareme.php"); //*** revoir bareme hono doit être dynamique */
                        $this->add_element($xw,"currency","EUR");
                        $this->add_element($xw,"city",$bien->ville);
                        $this->add_element($xw,"country_code",(($bien->pays == "Espagne") ? "es" : "fr") );
                        $this->add_element($xw,"property_type", $type_bien );

                        
                        $this->add_element($xw,"postal_code",$bien->code_postal);
                        $this->add_element($xw,"title_fr",$bien->titre_annonce);
                        $this->add_element($xw,"summary_fr",$bien->description_annonce);
                
                        $this->add_element($xw,"dpe_type","");
                        $this->add_element($xw,"dpe_value","");

                        xmlwriter_start_element($xw,"pics");

                        foreach ($bien->photosbiens as $photo){ 
                            if($photo->visibilite =="visible"){
                                xmlwriter_start_element($xw,"pic");
                                    xmlwriter_start_attribute($xw,"order");                        
                                        xmlwriter_text($xw, $photo->image_position);
                                    xmlwriter_end_attribute($xw);
                                    xmlwriter_start_attribute($xw,"last_update");                        
                                        xmlwriter_text($xw, $photo->updated_at->format('Y-m-j'));
                                    xmlwriter_end_attribute($xw);
                                    $this->add_element($xw,"url",url('/')."/images/photos_bien/".$photo->filename);
                                xmlwriter_end_element($xw);
                            }
                            
                        }

                        xmlwriter_end_element($xw);
                        
                    }
                }
             
                xmlwriter_end_element($xw);
            xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);
  
        //Fin  du document
    xmlwriter_end_document($xw);  

        file_put_contents ($this->passerelles_path.'/greenacres.xml',xmlwriter_output_memory($xw));
    // dd( xmlwriter_output_memory($xw) );
    }

/** Fonction d'export pour stylimmo
    * @author jean-philippe
    * @return \Illuminate\Http\Response
    **/	
    public function exportStylimmo($users_biens){
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
   
        // dd($users_biens);
        xmlwriter_start_element($xw,"hektor");

                foreach($users_biens as $user_biens){ 

                    foreach($user_biens[1] as $bien){
                        xmlwriter_start_element($xw,"ad");
                        
                            xmlwriter_start_element($xw,"id");

                                xmlwriter_start_attribute($xw,"dateEnr");                        
                                    xmlwriter_text($xw, $bien->created_at);
                                xmlwriter_end_attribute($xw);
                                xmlwriter_start_attribute($xw,"dateMaj");                        
                                    xmlwriter_text($xw, $bien->updated_at);
                                xmlwriter_end_attribute($xw);
                                xmlwriter_start_attribute($xw,"mandateKey");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);                                
                                
                                xmlwriter_text($xw, $bien->id);
                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"reference_client","");
                            $this->add_element_cdata($xw,"titre",$bien->titre_annonce);
                            $this->add_element_cdata($xw,"reference",$bien->numero_dossier);

                            // agence
                            xmlwriter_start_element($xw,"agence");                            
                                xmlwriter_start_attribute($xw,"siret");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw); 
                                xmlwriter_start_attribute($xw,"url");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);
                                xmlwriter_start_attribute($xw,"type");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);
                                                          
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, $user_biens[0]->nom.' '.$user_biens[0]->prenom);
                                xmlwriter_end_cdata($xw);

                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"type_offre", $bien->type_offre);
                            $this->add_element($xw,"type_offre_code",0); // Avoir la liste des types offre
                            $this->add_element($xw,"agenceLogo","http://stylimmo.la-boite-immo.com/images/logoadmin.jpg");

                            //agenceLocation
                            xmlwriter_start_element($xw,"agenceLocation");                            
                                xmlwriter_start_attribute($xw,"cp");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw); 
                                xmlwriter_start_attribute($xw,"latitude");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);
                                xmlwriter_start_attribute($xw,"longitude");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);
                                                        
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, "115 avenue de la roquette  bagnols sur ceze");
                                xmlwriter_end_cdata($xw);
                            xmlwriter_end_element($xw);

                            //agenceVille
                            xmlwriter_start_element($xw,"agenceVille");
                                xmlwriter_start_attribute($xw,"cp");                        
                                    xmlwriter_text($xw, "30200");
                                xmlwriter_end_attribute($xw);                            
                                                        
                            
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, "bagnols sur ceze");
                                xmlwriter_end_cdata($xw);
                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"cle_agence","stylimmo_".$user_biens[0]->id);
                            $this->add_element_cdata($xw,"telephone",$user_biens[0]->telephone);
                            $this->add_element_cdata($xw,"email",$user_biens[0]->email);
                            $this->add_element_cdata($xw,"corps", $bien->description_annonce);
                            $this->add_element_cdata($xw,"corps_impression",$bien->description_annonce);
                            $this->add_element($xw,"prix",$bien->prix_public);

                            $this->add_element_cdata($xw,"urlBaremeHono","http://www.stylimmo.com/bareme.php");
                            $this->add_element_cdata($xw,"honorairesPourcentageAcquereur","xxx");
                            $this->add_element($xw,"prixnetvendeur", $bien->prix_prive );
                            $this->add_element_cdata($xw,"url","xxx");
                            $this->add_element_cdata($xw,"numero_mandat",(isset ($bien->mandat_ok) ? $bien->mandat_ok->numero : ""));
                            $this->add_element($xw,"type_mandat", ( isset ($bien->mandat_ok) ? $bien->mandat_ok->type : ""));
                            $this->add_element($xw,"datedebut_mandat",( isset ($bien->mandat_ok) ? $bien->mandat_ok->date_debut : ""));
                            $this->add_element($xw,"datefin_mandat",( isset ($bien->mandat_ok) ? $bien->mandat_ok->date_fin : ""));
                            $this->add_element_cdata($xw,"type_bien", $bien->type_bien);
                            $this->add_element($xw,"type_bien_code","55");   // Obtenir la liste des code de type 

                            xmlwriter_start_element($xw,"surface_habitable");
                                xmlwriter_start_attribute($xw,"unit");                        
                                    xmlwriter_text($xw, "meters");
                                xmlwriter_end_attribute($xw);                        
                                                        
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, $bien->surface_habitable);
                                xmlwriter_end_cdata($xw);

                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"surface_terrain",$bien->surface_terrain);
                            $this->add_element_cdata($xw,"nb_pieces",$bien->nombre_piece);
                            $this->add_element_cdata($xw,"chambres",$bien->nombre_chambre);
                            $this->add_element_cdata($xw,"sdb",$bien->nb_salle_bain_agencement_interieur);
                            $this->add_element_cdata($xw,"cuisine",$bien->cuisine_etat_agencement_interieur);
                            $this->add_element_cdata($xw,"chauffage","");
                            $this->add_element_cdata($xw,"energie_chauffage","");
                            $this->add_element_cdata($xw,"format_chauffage","");

                            xmlwriter_start_element($xw,"chauffages");
                                xmlwriter_start_element($xw,"chauffage");
                                $this->add_element($xw,"type_chauffage","");
                                $this->add_element($xw,"energie_chauffage","");
                                $this->add_element($xw,"format_chauffage","");
                                xmlwriter_end_element($xw);
                            xmlwriter_end_element($xw);

                            $this->add_element($xw,"parking",$bien->parking_interieur_agencement_exterieur);
                            $this->add_element($xw,"piscine","");
                            $this->add_element($xw,"jardin","");
                            $this->add_element($xw,"terrasse",$bien->nombre_terrasse_agencement_exterieur);
                            $this->add_element($xw,"prestige","");
                            $this->add_element_cdata($xw,"annee_construction","xxx");

                            $this->add_element_cdata($xw,"annee_construction",$bien->annee_construction_diagnostic);
                            $this->add_element($xw,"dpe_non_concerne","");


                            $this->add_element($xw,"dpe_vierge", ($bien->dpe_vierge_diagnostic === "on") ? 1: 0);
                      
                            xmlwriter_start_element($xw,"pays");
                                xmlwriter_start_attribute($xw,"ISO");                        
                                    xmlwriter_text($xw,  ($bien->pays_annonce_secteur === "Espagne") ? "ES":"FR"); 
                                xmlwriter_end_attribute($xw);                        
                                                        
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, $bien->pays_annonce_secteur);
                                xmlwriter_end_cdata($xw);
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw,"ville");
                                xmlwriter_start_attribute($xw,"humanName");                        
                                    xmlwriter_text($xw,  $bien->ville); 
                                xmlwriter_end_attribute($xw);                        
                                                        
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, $bien->ville);
                                xmlwriter_end_cdata($xw);
                            xmlwriter_end_element($xw);
                            $this->add_element_cdata($xw,"cp",$bien->code_postal);
                           
                            $this->add_element($xw,"departement","");
                            $this->add_element($xw,"coup_de_coeur",""); // partie à implémenter
                           
                            xmlwriter_start_element($xw,"images");

                            foreach ($bien->photosbiens as $photo){ 
                                if($photo->visibilite =="visible"){ 
                                    $this->add_element_cdata($xw,"image",url('/')."/images/photos_bien/".$photo->filename); 
                                } 
                            }
                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"status","");
                            $this->add_element($xw,"meuble", ($bien->meuble_agencement_interieur === "Non") ? 0:1);

                        // fin ad
                        xmlwriter_end_element($xw);
                        
                    }
                }

        xmlwriter_end_element($xw);
  
        //Fin  du document
    xmlwriter_end_document($xw);  


        file_put_contents ($this->passerelles_path.'/stylimmo-outil.xml',xmlwriter_output_memory($xw));        
    // dd( xmlwriter_output_memory($xw) );
                $this->sendfile();
}


    /** Fonction d'export de seLoger
    * @author jean-philippe
    * @param  App\Models\PhotosBien
    * @return \Illuminate\Http\Response
    **/	
    public function exportSeLoger($users_biens){
         
         $fp = fopen($this->passerelles_path.'/Annonces.csv','w');
         $list = array();
        //  dd($users_biens);

         foreach($users_biens as $user_biens){
             foreach($user_biens[1] as $bien){
                
                array_push($list, array(
                   "code_agence_01!#"    //#1 Identifiant agence
                   ."ref_".$bien->id."!#"    //#2 Référence agence du bien
                   .$bien->type_offre."!#"   //#3 Type d’annonce
                   .$bien->type_bien."!#"    //#4 Type de bien
                   .$bien->code_postal."!#"   //#5 CP
                   .$bien->ville."!#"   //#6 Ville
                   .$bien->pays."!#"   //#7 Pays
                   .$bien->adresse."!#"   //#8 Adresse
                   .$bien->proximite_secteur."!#"   //#9 Quartier / Proximité
                   ."!#"   //#10 Activités commerciales
                   .($bien->type_offre == "location" ?  $bien->loyer : $bien->prix_public)."!#"   //#11 Prix / Loyer / Prix de cession
                   ."!#"   //#12 Loyer / mois murs
                   .$bien->loyer."!#"   //#13 Loyer CC
                   ."!#"   //#14 Loyer HT
                   .($bien->type_offre == "location" ?  750 : 5.5)."!#"   //#15 Honoraires  **********
                   .$bien->surface."!#"   //#16 Surface (m2)
                   .$bien->surface_terrain."!#"   //#17 Surface terrain (m2)
                   .$bien->nombre_piece."!#"   //#18 NB de pièces
                   .$bien->nombre_chambre."!#"   //#19 NB de chambres
                   .$bien->titre_annonce."!#"   //#20 Libellé
                   .$bien->description_annonce."!#"   //#21 Descriptif
                   .\Carbon\Carbon::parse($bien->disponible_le_dossier_dispo)->format('d/m/Y')."!#"   //#22 Date de disponibilité
                   .$bien->charge_mensuelle_total_info_fin."!#"   //#23 Charges
                   ."!#"   //#24 Etage
                   .$bien->etages_agencement_exterieur."!#"   //#25 NB d’étages
                   .($bien->meuble_agencement_interieur == "Oui" ? "Oui": "Non")."!#"   //#26 Meublé
                   .$bien->annee_construction_diagnostic."!#"   //#27 Année de construction
                   ."!#"   //#28 Refait à neuf
                   .$bien->nb_salle_bain_agencement_interieur."!#"   //#29 NB de salles de bain
                   .$bien->nb_salle_eau_agencement_interieur."!#"   //#30 NB de salles d’eau
                   .$bien->nb_wc_agencement_interieur."!#"   //#31 NB de WC
                   ."!#"   //#32 WC séparés
                   ."!#"   //#33 Type de chauffage
                   ."!#"   //#34 Type de cuisine
                   ."!#"   //#35 Orientation sud
                   ."!#"   //#36 Orientation est
                   ."!#"   //#37 Orientation ouest
                   ."!#"   //#38 Orientation nord
                   .$bien->nb_balcon_agencement_exterieur."!#"   //#39 NB balcons
                   .$bien->surface_balcon_agencement_exterieur."!#"   //#40 SF Balcon
                   .($bien->ascenseur_equipement == "Oui" ? "Oui": "Non")."!#"   //#41 Ascenseur
                   ."!#"   //#42 Cave
                   .( $bien->parking_interieur_agencement_exterieur + $bien->parking_exterieur_agencement_exterieur)."!#"   //#43 NB de parkings
                   ."!#"   //#44 NB de boxes
                   ."!#"   //#45 Digicode
                   ."!#"   //#46 Interphone
                   ."!#"   //#47 Gardien
                   .($bien->terrasse_agencement_exterieur == "Oui" ? "Oui": "Non")."!#"   //#48 Terrasse
                   ."!#"   //#49 Prix semaine Basse Saison
                   ."!#"   //#50 Prix quinzaine Basse Saison
                   ."!#"   //#51 Prix mois / Basse Saison
                   ."!#"   //#52 Prix semaine Haute Saison
                   ."!#"   //#53 Prix quinzaine Haute Saison
                   ."!#"   //#54 Prix mois Haute Saison
                   ."!#"   //#55 NB de personnes
                   ."!#"   //#56 Type de résidence
                   ."!#"   //#57 Situation
                   ."!#"   //#58 NB de couverts
                   ."!#"   //#59 NB de lits doubles
                   ."!#"   //#60 NB de lits simples
                   ."!#"   //#61 Alarme
                   ."!#"   //#62 Câble TV
                   ."!#"   //#63 Calme
                   ."!#"   //#64 Climatisation
                   .($bien->piscine == "Oui" ? "Oui": "Non")."!#"   //#65 Piscine
                   .($bien->acces_handicape_equipement == "Oui" ? "Oui": "Non")."!#"   //#66 Aménagement pour handicapés
                   ."!#"   //#67 Animaux acceptés
                   ."!#"   //#68 Cheminée
                   ."!#"   //#69 Congélateur
                   ."!#"   //#70 Four
                   ."!#"   //#71 Lave-vaisselle
                   ."!#"   //#72 Micro-ondes
                   ."!#"   //#73 Placards
                   ."!#"   //#74 Téléphone
                   ."!#"   //#75 Proche lac
                   ."!#"   //#76 Proche tennis
                   ."!#"   //#77 Proche pistes de ski
                   ."!#"   //#78 Vue dégagée
                   ."!#"   //#79 Chiffre d’affaire
                   ."!#"   //#80 Longueur façade (m)
                   ."!#"   //#81 Duplex
                   ."!#"   //#82 Publications
                   .( isset ($bien->mandat_ok) ? ($bien->mandat_ok->type =="exclusif" ? "Oui" : "Non") : "" )."!#"   //#83 Mandat en exclusivité
                   ."!#"   //#84 Coup de coeur
                   .( isset($bien->photosbiens[0]) ? url('/')."/images/photos_bien/".$bien->photosbiens[0]->filename : "")."!#"   //#85 Photo 1
                   .( isset($bien->photosbiens[1]) ? url('/')."/images/photos_bien/".$bien->photosbiens[1]->filename : "")."!#"   //#86 Photo 2
                   .( isset($bien->photosbiens[2]) ? url('/')."/images/photos_bien/".$bien->photosbiens[2]->filename : "")."!#"   //#87 Photo 3
                   .( isset($bien->photosbiens[3]) ? url('/')."/images/photos_bien/".$bien->photosbiens[3]->filename : "")."!#"   //#88 Photo 4
                   .( isset($bien->photosbiens[4]) ? url('/')."/images/photos_bien/".$bien->photosbiens[4]->filename : "")."!#"   //#89 Photo 5
                   .( isset($bien->photosbiens[5]) ? url('/')."/images/photos_bien/".$bien->photosbiens[5]->filename : "")."!#"   //#90 Photo 6
                   .( isset($bien->photosbiens[6]) ? url('/')."/images/photos_bien/".$bien->photosbiens[6]->filename : "")."!#"   //#91 Photo 7
                   .( isset($bien->photosbiens[7]) ? url('/')."/images/photos_bien/".$bien->photosbiens[7]->filename : "")."!#"   //#92 Photo 8
                   .( isset($bien->photosbiens[8]) ? url('/')."/images/photos_bien/".$bien->photosbiens[8]->filename : "")."!#"   //#93 Photo 9
                   ."!#"   //#94 Titre photo 1
                   ."!#"   //#95 Titre photo 2
                   ."!#"   //#96 Titre photo 3
                   ."!#"   //#97 Titre photo 4
                   ."!#"   //#98 Titre photo 5
                   ."!#"   //#99 Titre photo 6
                   ."!#"   //#100 Titre photo 7
                   ."!#"   //#101 Titre photo 8
                   ."!#"   //#102 Titre photo 9
                   ."!#"   //#103 Photo panoramique
                   ."!#"   //#104 URL visite virtuelle
                   .$user_biens[0]->telephone."!#"   //#105 Téléphone à afficher
                   ."!#"   //#106 Contact à afficher
                   .$user_biens[0]->email."!#"   //#107 Email de contact
                   .$bien->xxxxxxxxxx."!#"   //#108 CP Réel du bien
                   .$bien->xxxxxxxxxx."!#"   //#109 Ville réelle du bien
                   .$bien->xxxxxxxxxx."!#"   //#110 Inter-cabinet
                   .$bien->xxxxxxxxxx."!#"   //#111 Inter-cabinet prive
                   .$bien->xxxxxxxxxx."!#"   //#112 N° de mandat
                   .$bien->xxxxxxxxxx."!#"   //#113 Date mandat
                   .$bien->xxxxxxxxxx."!#"   //#114 Nom mandataire
                   .$bien->xxxxxxxxxx."!#"   //#115 Prénom mandataire
                   .$bien->xxxxxxxxxx."!#"   //#116 Raison sociale mandataire
                   .$bien->xxxxxxxxxx."!#"   //#117 Adresse mandataire
                   .$bien->xxxxxxxxxx."!#"   //#118 CP mandataire
                   .$bien->xxxxxxxxxx."!#"   //#119 Ville mandataire
                   .$bien->xxxxxxxxxx."!#"   //#120 Téléphone mandataire
                   .$bien->xxxxxxxxxx."!#"   //#121 Commentaires mandataire
                   .$bien->xxxxxxxxxx."!#"   //#122 Commentaires privés
                   .$bien->xxxxxxxxxx."!#"   //#123 Code négociateur
                   .$bien->xxxxxxxxxx."!#"   //#124 Code Langue 1
                   .$bien->xxxxxxxxxx."!#"   //#125 Proximité Langue 1
                   .$bien->xxxxxxxxxx."!#"   //#126 Libellé Langue 1
                   .$bien->xxxxxxxxxx."!#"   //#127 Descriptif Langue 1
                   .$bien->xxxxxxxxxx."!#"   //#128 Code Langue 2
                   .$bien->xxxxxxxxxx."!#"   //#129 Proximité Langue 2
                   .$bien->xxxxxxxxxx."!#"   //#130 Libellé Langue 2
                   .$bien->xxxxxxxxxx."!#"   //#131 Descriptif Langue 2
                   .$bien->xxxxxxxxxx."!#"   //#132 Code Langue 3
                   .$bien->xxxxxxxxxx."!#"   //#133 Proximité Langue 3
                   .$bien->xxxxxxxxxx."!#"   //#134 Libellé Langue 3
                   .$bien->xxxxxxxxxx."!#"   //#135 Descriptif Langue 3
                   .$bien->xxxxxxxxxx."!#"   //#136 Champ personnalisé 1
                   .$bien->xxxxxxxxxx."!#"   //#137 Champ personnalisé 2
                   .$bien->xxxxxxxxxx."!#"   //#138 Champ personnalisé 3
                   .$bien->xxxxxxxxxx."!#"   //#139 Champ personnalisé 4
                   .$bien->xxxxxxxxxx."!#"   //#140 Champ personnalisé 5
                   .$bien->xxxxxxxxxx."!#"   //#141 Champ personnalisé 6
                   .$bien->xxxxxxxxxx."!#"   //#142 Champ personnalisé 7
                   .$bien->xxxxxxxxxx."!#"   //#143 Champ personnalisé 8
                   .$bien->xxxxxxxxxx."!#"   //#144 Champ personnalisé 9
                   .$bien->xxxxxxxxxx."!#"   //#145 Champ personnalisé 10
                   .$bien->xxxxxxxxxx."!#"   //#146 Champ personnalisé 11
                   .$bien->xxxxxxxxxx."!#"   //#147 Champ personnalisé 12
                   .$bien->xxxxxxxxxx."!#"   //#148 Champ personnalisé 13
                   .$bien->xxxxxxxxxx."!#"   //#149 Champ personnalisé 14
                   .$bien->xxxxxxxxxx."!#"   //#150 Champ personnalisé 15
                   .$bien->xxxxxxxxxx."!#"   //#151 Champ personnalisé 16
                   .$bien->xxxxxxxxxx."!#"   //#152 Champ personnalisé 17
                   .$bien->xxxxxxxxxx."!#"   //#153 Champ personnalisé 18
                   .$bien->xxxxxxxxxx."!#"   //#154 Champ personnalisé 19
                   .$bien->xxxxxxxxxx."!#"   //#155 Champ personnalisé 20
                   .$bien->xxxxxxxxxx."!#"   //#156 Champ personnalisé 21
                   .$bien->xxxxxxxxxx."!#"   //#157 Champ personnalisé 22
                   .$bien->xxxxxxxxxx."!#"   //#158 Champ personnalisé 23
                   .$bien->xxxxxxxxxx."!#"   //#159 Champ personnalisé 24
                   .$bien->xxxxxxxxxx."!#"   //#160 Champ personnalisé 25
                   .$bien->xxxxxxxxxx."!#"   //#161 Dépôt de garantie
                   .$bien->xxxxxxxxxx."!#"   //#162 Récent
                   .$bien->xxxxxxxxxx."!#"   //#163 Travaux à prévoir
                   .( isset($bien->photosbiens[0]) ? url('/')."/images/photos_bien/".$bien->photosbiens[0]->filename : "")."!#"   //#164 Photo 10
                   .( isset($bien->photosbiens[1]) ? url('/')."/images/photos_bien/".$bien->photosbiens[1]->filename : "")."!#"   //#165 Photo 11
                   .( isset($bien->photosbiens[2]) ? url('/')."/images/photos_bien/".$bien->photosbiens[2]->filename : "")."!#"   //#166 Photo 12
                   .( isset($bien->photosbiens[3]) ? url('/')."/images/photos_bien/".$bien->photosbiens[3]->filename : "")."!#"   //#167 Photo 13
                   .( isset($bien->photosbiens[4]) ? url('/')."/images/photos_bien/".$bien->photosbiens[4]->filename : "")."!#"   //#168 Photo 14
                   .( isset($bien->photosbiens[5]) ? url('/')."/images/photos_bien/".$bien->photosbiens[5]->filename : "")."!#"   //#169 Photo 15
                   .( isset($bien->photosbiens[6]) ? url('/')."/images/photos_bien/".$bien->photosbiens[6]->filename : "")."!#"   //#170 Photo 16
                   .( isset($bien->photosbiens[7]) ? url('/')."/images/photos_bien/".$bien->photosbiens[7]->filename : "")."!#"   //#171 Photo 17
                   .( isset($bien->photosbiens[8]) ? url('/')."/images/photos_bien/".$bien->photosbiens[8]->filename : "")."!#"   //#172 Photo 18
                   .( isset($bien->photosbiens[8]) ? url('/')."/images/photos_bien/".$bien->photosbiens[8]->filename : "")."!#"   //#173 Photo 19
                   .( isset($bien->photosbiens[8]) ? url('/')."/images/photos_bien/".$bien->photosbiens[8]->filename : "")."!#"   //#174 Photo 20
                   ."id_tech".$bien->id."!#"   //#175 Identifiant technique  *************
                   .$bien->xxxxxxxxxx."!#"   //#176 Consommation énergie
                   .$bien->xxxxxxxxxx."!#"   //#177 Bilan consommation énergie
                   .$bien->xxxxxxxxxx."!#"   //#178 Emissions GES
                   .$bien->xxxxxxxxxx."!#"   //#179 Bilan émission GES
                   .$bien->xxxxxxxxxx."!#"   //#180 Identifiant quartier (obsolète)
                   .$bien->xxxxxxxxxx."!#"   //#181 Sous type de bien
                   .$bien->xxxxxxxxxx."!#"   //#182 Périodes de disponibilité
                   .$bien->xxxxxxxxxx."!#"   //#183 Périodes basse saison
                   .$bien->xxxxxxxxxx."!#"   //#184 Périodes haute saison
                   .$bien->xxxxxxxxxx."!#"   //#185 Prix du bouquet
                   .$bien->xxxxxxxxxx."!#"   //#186 Rente mensuelle
                   .$bien->xxxxxxxxxx."!#"   //#187 Age de l’homme
                   .$bien->xxxxxxxxxx."!#"   //#188 Age de la femme
                   .$bien->xxxxxxxxxx."!#"   //#189 Entrée
                   .$bien->xxxxxxxxxx."!#"   //#190 Résidence
                   .$bien->xxxxxxxxxx."!#"   //#191 Parquet
                   .$bien->xxxxxxxxxx."!#"   //#192 Vis-à-vis
                   .$bien->xxxxxxxxxx."!#"   //#193 Transport : Ligne
                   .$bien->xxxxxxxxxx."!#"   //#194 Transport : Station
                   .$bien->xxxxxxxxxx."!#"   //#195 Durée bail
                   .$bien->xxxxxxxxxx."!#"   //#196 Places en salle
                   .$bien->xxxxxxxxxx."!#"   //#197 Monte-charge
                   .$bien->xxxxxxxxxx."!#"   //#198 Quai
                   .$bien->xxxxxxxxxx."!#"   //#199 Nombre de bureaux
                   .$bien->xxxxxxxxxx."!#"   //#200 Prix du droit d’entrée
                   .$bien->xxxxxxxxxx."!#"   //#201 Prix masqué
                   .$bien->xxxxxxxxxx."!#"   //#202 Loyer annuel global
                   .$bien->xxxxxxxxxx."!#"   //#203 Charges annuelles globales
                   .$bien->xxxxxxxxxx."!#"   //#204 Loyer annuel au m2
                   .$bien->xxxxxxxxxx."!#"   //#205 Charges annuelles au m2
                   .$bien->xxxxxxxxxx."!#"   //#206 Charges mensuelles HT
                   .$bien->xxxxxxxxxx."!#"   //#207 Loyer annuel CC
                   .$bien->xxxxxxxxxx."!#"   //#208 Loyer annuel HT
                   .$bien->xxxxxxxxxx."!#"   //#209 Charges annuelles HT
                   .$bien->xxxxxxxxxx."!#"   //#210 Loyer annuel au m2 CC
                   .$bien->xxxxxxxxxx."!#"   //#211 Loyer annuel au m2 HT
                   .$bien->xxxxxxxxxx."!#"   //#212 Charges annuelles au m2 HT
                   .$bien->xxxxxxxxxx."!#"   //#213 Divisible
                   .$bien->xxxxxxxxxx."!#"   //#214 Surface divisible minimale
                   .$bien->xxxxxxxxxx."!#"   //#215 Surface divisible maximale
                   .$bien->xxxxxxxxxx."!#"   //#216 Surface séjour
                   .$bien->xxxxxxxxxx."!#"   //#217 Nombre de véhicules
                   .$bien->xxxxxxxxxx."!#"   //#218 Prix du droit au bail
                   .$bien->xxxxxxxxxx."!#"   //#219 Valeur à l’achat
                   .$bien->xxxxxxxxxx."!#"   //#220 Répartition du chiffre d’affaire
                   .$bien->xxxxxxxxxx."!#"   //#221 Terrain agricole
                   .$bien->xxxxxxxxxx."!#"   //#222 Equipement bébé
                   .$bien->xxxxxxxxxx."!#"   //#223 Terrain constructible
                   .$bien->xxxxxxxxxx."!#"   //#224 Résultat Année N-2
                   .$bien->xxxxxxxxxx."!#"   //#225 Résultat Année N-1
                   .$bien->xxxxxxxxxx."!#"   //#226 Résultat Actuel
                   .$bien->xxxxxxxxxx."!#"   //#227 Immeuble de parkings
                   .$bien->xxxxxxxxxx."!#"   //#228 Parking isolé
                   .$bien->xxxxxxxxxx."!#"   //#229 Si Viager Vendu Libre
                   .$bien->xxxxxxxxxx."!#"   //#230 Logement à disposition
                   .$bien->xxxxxxxxxx."!#"   //#231 Terrain en pente
                   .$bien->xxxxxxxxxx."!#"   //#232 Plan d’eau
                   .$bien->xxxxxxxxxx."!#"   //#233 Lave-linge
                   .$bien->xxxxxxxxxx."!#"   //#234 Sèche-linge
                   .$bien->xxxxxxxxxx."!#"   //#235 Connexion internet
                   .$bien->xxxxxxxxxx."!#"   //#236 Chiffre affaire Année N-2
                   .$bien->xxxxxxxxxx."!#"   //#237 Chiffre affaire Année N-1
                   .$bien->xxxxxxxxxx."!#"   //#238 Conditions financières
                   .$bien->xxxxxxxxxx."!#"   //#239 Prestations diverses
                   .$bien->xxxxxxxxxx."!#"   //#240 Longueur façade
                   .$bien->xxxxxxxxxx."!#"   //#241 Montant du rapport
                   .$bien->xxxxxxxxxx."!#"   //#242 Nature du bail
                   .$bien->xxxxxxxxxx."!#"   //#243 Nature bail commercial
                   .$bien->xxxxxxxxxx."!#"   //#244 Nombre terrasses
                   .$bien->xxxxxxxxxx."!#"   //#245 Prix hors taxes
                   .$bien->xxxxxxxxxx."!#"   //#246 Si Salle à manger
                   .$bien->xxxxxxxxxx."!#"   //#247 Si Séjour
                   .$bien->xxxxxxxxxx."!#"   //#248 Terrain donne sur la rue
                   .$bien->xxxxxxxxxx."!#"   //#249 Immeuble de type bureaux
                   .$bien->xxxxxxxxxx."!#"   //#250 Terrain viabilisé
                   .$bien->xxxxxxxxxx."!#"   //#251 Equipement Vidéo
                   .$bien->xxxxxxxxxx."!#"   //#252 Surface de la cave
                   .$bien->xxxxxxxxxx."!#"   //#253 Surface de la salle à manger
                   .$bien->xxxxxxxxxx."!#"   //#254 Situation commerciale
                   .$bien->xxxxxxxxxx."!#"   //#255 Surface maximale d’un bureau
                   .$bien->xxxxxxxxxx."!#"   //#256 Honoraires charge acquéreur (obsolète)
                   .$bien->xxxxxxxxxx."!#"   //#257 Pourcentage honoraires TTC (obsolète)
                   .$bien->xxxxxxxxxx."!#"   //#258 En copropriété
                   .$bien->xxxxxxxxxx."!#"   //#259 Nombre de lots
                   .$bien->xxxxxxxxxx."!#"   //#260 Charges annuelles
                   .$bien->xxxxxxxxxx."!#"   //#261 Syndicat des copropriétaires en procédure
                   .$bien->xxxxxxxxxx."!#"   //#262 Détail procédure du syndicat des copropriétaires
                   .$bien->xxxxxxxxxx."!#"   //#263 Champ personnalisé 26
                   .( isset($bien->photosbiens[21]) ? url('/')."/images/photos_bien/".$bien->photosbiens[21]->filename : "")."!#"   //#264 Photo 21
                   .( isset($bien->photosbiens[22]) ? url('/')."/images/photos_bien/".$bien->photosbiens[22]->filename : "")."!#"   //#265 Photo 22
                   .( isset($bien->photosbiens[23]) ? url('/')."/images/photos_bien/".$bien->photosbiens[23]->filename : "")."!#"   //#266 Photo 23
                   .( isset($bien->photosbiens[24]) ? url('/')."/images/photos_bien/".$bien->photosbiens[24]->filename : "")."!#"   //#267 Photo 24
                   .( isset($bien->photosbiens[25]) ? url('/')."/images/photos_bien/".$bien->photosbiens[25]->filename : "")."!#"   //#268 Photo 25
                   .( isset($bien->photosbiens[26]) ? url('/')."/images/photos_bien/".$bien->photosbiens[26]->filename : "")."!#"   //#269 Photo 26
                   .( isset($bien->photosbiens[27]) ? url('/')."/images/photos_bien/".$bien->photosbiens[27]->filename : "")."!#"   //#270 Photo 27
                   .( isset($bien->photosbiens[28]) ? url('/')."/images/photos_bien/".$bien->photosbiens[28]->filename : "")."!#"   //#271 Photo 28
                   .( isset($bien->photosbiens[29]) ? url('/')."/images/photos_bien/".$bien->photosbiens[29]->filename : "")."!#"   //#272 Photo 29
                   .( isset($bien->photosbiens[30]) ? url('/')."/images/photos_bien/".$bien->photosbiens[30]->filename : "")."!#"   //#273 Photo 30
                   ."!#"   //#274 Titre photo 10
                   ."!#"   //#275 Titre photo 11
                   ."!#"   //#276 Titre photo 12
                   ."!#"   //#277 Titre photo 13
                   ."!#"   //#278 Titre photo 14
                   ."!#"   //#279 Titre photo 15
                   ."!#"   //#280 Titre photo 16
                   ."!#"   //#281 Titre photo 17
                   ."!#"   //#282 Titre photo 18
                   ."!#"   //#283 Titre photo 19
                   ."!#"   //#284 Titre photo 20
                   ."!#"   //#285 Titre photo 21
                   ."!#"   //#286 Titre photo 22
                   ."!#"   //#287 Titre photo 23
                   ."!#"   //#288 Titre photo 24
                   ."!#"   //#289 Titre photo 25
                   ."!#"   //#290 Titre photo 26
                   ."!#"   //#291 Titre photo 27
                   ."!#"   //#292 Titre photo 28
                   ."!#"   //#293 Titre photo 29
                   ."!#"   //#294 Titre photo 30
                   ."!#"   //#295 Prix du terrain
                   ."!#"   //#296 Prix du modèle de maison
                   ."!#"   //#297 Nom de l'agence gérant le terrain
                   ."!#"   //#298 Latitude
                   ."!#"   //#299 Longitude
                   ."!#"   //#300 Précision GPS
                   ."4.08-006!#"   //#301 Version Format
                   ."1!#"   //#302 Honoraires à la charge de
                   ."1200000!#"   //#303 Prix hors honoraires acquéreur
                   ."1!#"   //#304 Modalités charges locataire   ***********
                   ."!#"   //#305 Complément loyer
                   ."300!#"   //#306 Part honoraires état des lieux
                )
                );
                
             }
         }
         
        //  dd($list);
         foreach ($list as $fields) {
             fputcsv($fp, $fields);
         }
         
         fclose($fp);
        // dd($users_biens);

    }

    /** Fonction d'export de Paruvendu
    * @author jean-philippe
    * @param  App\Models\PhotosBien
    * @return \Illuminate\Http\Response
    **/	
    public function exportParuvendu($users_biens){
         
        $fp = fopen($this->passerelles_path.'/Annonces2.csv','w');
        $list = array();
       //  dd($users_biens);

        foreach($users_biens as $user_biens){
            foreach($user_biens[1] as $bien){
               
               array_push($list, array(
                  "code_agence_01!#"    //#1 Identifiant agence
                  ."ref_".$bien->id."!#"    //#2 Référence agence du bien
                  .$bien->type_offre."!#"   //#3 Type d’annonce
                  .$bien->type_bien."!#"    //#4 Type de bien
                  .$bien->code_postal."!#"   //#5 CP
                  .$bien->ville."!#"   //#6 Ville
                  .$bien->pays."!#"   //#7 Pays
                  .$bien->adresse."!#"   //#8 Adresse
                  .$bien->proximite_secteur."!#"   //#9 Quartier / Proximité
                  ."!#"   //#10 Activités commerciales
                  .($bien->type_offre == "location" ?  $bien->loyer : $bien->prix_public)."!#"   //#11 Prix / Loyer / Prix de cession
                  ."!#"   //#12 Loyer / mois murs
                  .$bien->loyer."!#"   //#13 Loyer CC
                  ."!#"   //#14 Loyer HT
                  .($bien->type_offre == "location" ?  750 : 5.5)."!#"   //#15 Honoraires  **********
                  .$bien->surface."!#"   //#16 Surface (m2)
                  .$bien->surface_terrain."!#"   //#17 Surface terrain (m2)
                  .$bien->nombre_piece."!#"   //#18 NB de pièces
                  .$bien->nombre_chambre."!#"   //#19 NB de chambres
                  .$bien->titre_annonce."!#"   //#20 Libellé
                  .$bien->description_annonce."!#"   //#21 Descriptif
                  .\Carbon\Carbon::parse($bien->disponible_le_dossier_dispo)->format('d/m/Y')."!#"   //#22 Date de disponibilité
                  .$bien->charge_mensuelle_total_info_fin."!#"   //#23 Charges
                  ."!#"   //#24 Etage
                  .$bien->etages_agencement_exterieur."!#"   //#25 NB d’étages
                  .($bien->meuble_agencement_interieur == "Oui" ? "Oui": "Non")."!#"   //#26 Meublé
                  .$bien->annee_construction_diagnostic."!#"   //#27 Année de construction
                  ."!#"   //#28 Refait à neuf
                  .$bien->nb_salle_bain_agencement_interieur."!#"   //#29 NB de salles de bain
                  .$bien->nb_salle_eau_agencement_interieur."!#"   //#30 NB de salles d’eau
                  .$bien->nb_wc_agencement_interieur."!#"   //#31 NB de WC
                  ."!#"   //#32 WC séparés
                  ."!#"   //#33 Type de chauffage
                  ."!#"   //#34 Type de cuisine
                  ."!#"   //#35 Orientation sud
                  ."!#"   //#36 Orientation est
                  ."!#"   //#37 Orientation ouest
                  ."!#"   //#38 Orientation nord
                  .$bien->nb_balcon_agencement_exterieur."!#"   //#39 NB balcons
                  .$bien->surface_balcon_agencement_exterieur."!#"   //#40 SF Balcon
                  .($bien->ascenseur_equipement == "Oui" ? "Oui": "Non")."!#"   //#41 Ascenseur
                  ."!#"   //#42 Cave
                  .( $bien->parking_interieur_agencement_exterieur + $bien->parking_exterieur_agencement_exterieur)."!#"   //#43 NB de parkings
                  ."!#"   //#44 NB de boxes
                  ."!#"   //#45 Digicode
                  ."!#"   //#46 Interphone
                  ."!#"   //#47 Gardien
                  .($bien->terrasse_agencement_exterieur == "Oui" ? "Oui": "Non")."!#"   //#48 Terrasse
                  ."!#"   //#49 Prix semaine Basse Saison
                  ."!#"   //#50 Prix quinzaine Basse Saison
                  ."!#"   //#51 Prix mois / Basse Saison
                  ."!#"   //#52 Prix semaine Haute Saison
                  ."!#"   //#53 Prix quinzaine Haute Saison
                  ."!#"   //#54 Prix mois Haute Saison
                  ."!#"   //#55 NB de personnes
                  ."!#"   //#56 Type de résidence
                  ."!#"   //#57 Situation
                  ."!#"   //#58 NB de couverts
                  ."!#"   //#59 NB de lits doubles
                  ."!#"   //#60 NB de lits simples
                  ."!#"   //#61 Alarme
                  ."!#"   //#62 Câble TV
                  ."!#"   //#63 Calme
                  ."!#"   //#64 Climatisation
                  .($bien->piscine == "Oui" ? "Oui": "Non")."!#"   //#65 Piscine
                  .($bien->acces_handicape_equipement == "Oui" ? "Oui": "Non")."!#"   //#66 Aménagement pour handicapés
                  ."!#"   //#67 Animaux acceptés
                  ."!#"   //#68 Cheminée
                  ."!#"   //#69 Congélateur
                  ."!#"   //#70 Four
                  ."!#"   //#71 Lave-vaisselle
                  ."!#"   //#72 Micro-ondes
                  ."!#"   //#73 Placards
                  ."!#"   //#74 Téléphone
                  ."!#"   //#75 Proche lac
                  ."!#"   //#76 Proche tennis
                  ."!#"   //#77 Proche pistes de ski
                  ."!#"   //#78 Vue dégagée
                  ."!#"   //#79 Chiffre d’affaire
                  ."!#"   //#80 Longueur façade (m)
                  ."!#"   //#81 Duplex
                  ."!#"   //#82 Publications
                  .( isset ($bien->mandat_ok) ? ($bien->mandat_ok->type =="exclusif" ? "Oui" : "Non") : "" )."!#"   //#83 Mandat en exclusivité
                  ."!#"   //#84 Coup de coeur
                  .( isset($bien->photosbiens[0]) ? url('/')."/images/photos_bien/".$bien->photosbiens[0]->filename : "")."!#"   //#85 Photo 1
                  .( isset($bien->photosbiens[1]) ? url('/')."/images/photos_bien/".$bien->photosbiens[1]->filename : "")."!#"   //#86 Photo 2
                  .( isset($bien->photosbiens[2]) ? url('/')."/images/photos_bien/".$bien->photosbiens[2]->filename : "")."!#"   //#87 Photo 3
                  .( isset($bien->photosbiens[3]) ? url('/')."/images/photos_bien/".$bien->photosbiens[3]->filename : "")."!#"   //#88 Photo 4
                  .( isset($bien->photosbiens[4]) ? url('/')."/images/photos_bien/".$bien->photosbiens[4]->filename : "")."!#"   //#89 Photo 5
                  .( isset($bien->photosbiens[5]) ? url('/')."/images/photos_bien/".$bien->photosbiens[5]->filename : "")."!#"   //#90 Photo 6
                  .( isset($bien->photosbiens[6]) ? url('/')."/images/photos_bien/".$bien->photosbiens[6]->filename : "")."!#"   //#91 Photo 7
                  .( isset($bien->photosbiens[7]) ? url('/')."/images/photos_bien/".$bien->photosbiens[7]->filename : "")."!#"   //#92 Photo 8
                  .( isset($bien->photosbiens[8]) ? url('/')."/images/photos_bien/".$bien->photosbiens[8]->filename : "")."!#"   //#93 Photo 9
                  ."!#"   //#94 Titre photo 1
                  ."!#"   //#95 Titre photo 2
                  ."!#"   //#96 Titre photo 3
                  ."!#"   //#97 Titre photo 4
                  ."!#"   //#98 Titre photo 5
                  ."!#"   //#99 Titre photo 6
                  ."!#"   //#100 Titre photo 7
                  ."!#"   //#101 Titre photo 8
                  ."!#"   //#102 Titre photo 9
                  ."!#"   //#103 Photo panoramique
                  ."!#"   //#104 URL visite virtuelle
                  .$user_biens[0]->telephone."!#"   //#105 Téléphone à afficher
                  ."!#"   //#106 Contact à afficher
                  .$user_biens[0]->email."!#"   //#107 Email de contact
                  .$bien->xxxxxxxxxx."!#"   //#108 CP Réel du bien
                  .$bien->xxxxxxxxxx."!#"   //#109 Ville réelle du bien
                  .$bien->xxxxxxxxxx."!#"   //#110 Inter-cabinet
                  .$bien->xxxxxxxxxx."!#"   //#111 Inter-cabinet prive
                  .$bien->xxxxxxxxxx."!#"   //#112 N° de mandat
                  .$bien->xxxxxxxxxx."!#"   //#113 Date mandat
                  .$bien->xxxxxxxxxx."!#"   //#114 Nom mandataire
                  .$bien->xxxxxxxxxx."!#"   //#115 Prénom mandataire
                  .$bien->xxxxxxxxxx."!#"   //#116 Raison sociale mandataire
                  .$bien->xxxxxxxxxx."!#"   //#117 Adresse mandataire
                  .$bien->xxxxxxxxxx."!#"   //#118 CP mandataire
                  .$bien->xxxxxxxxxx."!#"   //#119 Ville mandataire
                  .$bien->xxxxxxxxxx."!#"   //#120 Téléphone mandataire
                  .$bien->xxxxxxxxxx."!#"   //#121 Commentaires mandataire
                  .$bien->xxxxxxxxxx."!#"   //#122 Commentaires privés
                  .$bien->xxxxxxxxxx."!#"   //#123 Code négociateur
                  .$bien->xxxxxxxxxx."!#"   //#124 Code Langue 1
                  .$bien->xxxxxxxxxx."!#"   //#125 Proximité Langue 1
                  .$bien->xxxxxxxxxx."!#"   //#126 Libellé Langue 1
                  .$bien->xxxxxxxxxx."!#"   //#127 Descriptif Langue 1
                  .$bien->xxxxxxxxxx."!#"   //#128 Code Langue 2
                  .$bien->xxxxxxxxxx."!#"   //#129 Proximité Langue 2
                  .$bien->xxxxxxxxxx."!#"   //#130 Libellé Langue 2
                  .$bien->xxxxxxxxxx."!#"   //#131 Descriptif Langue 2
                  .$bien->xxxxxxxxxx."!#"   //#132 Code Langue 3
                  .$bien->xxxxxxxxxx."!#"   //#133 Proximité Langue 3
                  .$bien->xxxxxxxxxx."!#"   //#134 Libellé Langue 3
                  .$bien->xxxxxxxxxx."!#"   //#135 Descriptif Langue 3
                  .$bien->xxxxxxxxxx."!#"   //#136 Champ personnalisé 1
                  .$bien->xxxxxxxxxx."!#"   //#137 Champ personnalisé 2
                  .$bien->xxxxxxxxxx."!#"   //#138 Champ personnalisé 3
                  .$bien->xxxxxxxxxx."!#"   //#139 Champ personnalisé 4
                  .$bien->xxxxxxxxxx."!#"   //#140 Champ personnalisé 5
                  .$bien->xxxxxxxxxx."!#"   //#141 Champ personnalisé 6
                  .$bien->xxxxxxxxxx."!#"   //#142 Champ personnalisé 7
                  .$bien->xxxxxxxxxx."!#"   //#143 Champ personnalisé 8
                  .$bien->xxxxxxxxxx."!#"   //#144 Champ personnalisé 9
                  .$bien->xxxxxxxxxx."!#"   //#145 Champ personnalisé 10
                  .$bien->xxxxxxxxxx."!#"   //#146 Champ personnalisé 11
                  .$bien->xxxxxxxxxx."!#"   //#147 Champ personnalisé 12
                  .$bien->xxxxxxxxxx."!#"   //#148 Champ personnalisé 13
                  .$bien->xxxxxxxxxx."!#"   //#149 Champ personnalisé 14
                  .$bien->xxxxxxxxxx."!#"   //#150 Champ personnalisé 15
                  .$bien->xxxxxxxxxx."!#"   //#151 Champ personnalisé 16
                  .$bien->xxxxxxxxxx."!#"   //#152 Champ personnalisé 17
                  .$bien->xxxxxxxxxx."!#"   //#153 Champ personnalisé 18
                  .$bien->xxxxxxxxxx."!#"   //#154 Champ personnalisé 19
                  .$bien->xxxxxxxxxx."!#"   //#155 Champ personnalisé 20
                  .$bien->xxxxxxxxxx."!#"   //#156 Champ personnalisé 21
                  .$bien->xxxxxxxxxx."!#"   //#157 Champ personnalisé 22
                  .$bien->xxxxxxxxxx."!#"   //#158 Champ personnalisé 23
                  .$bien->xxxxxxxxxx."!#"   //#159 Champ personnalisé 24
                  .$bien->xxxxxxxxxx."!#"   //#160 Champ personnalisé 25
                  .$bien->xxxxxxxxxx."!#"   //#161 Dépôt de garantie
                  .$bien->xxxxxxxxxx."!#"   //#162 Récent
                  .$bien->xxxxxxxxxx."!#"   //#163 Travaux à prévoir
                  .( isset($bien->photosbiens[0]) ? url('/')."/images/photos_bien/".$bien->photosbiens[0]->filename : "")."!#"   //#164 Photo 10
                  .( isset($bien->photosbiens[1]) ? url('/')."/images/photos_bien/".$bien->photosbiens[1]->filename : "")."!#"   //#165 Photo 11
                  .( isset($bien->photosbiens[2]) ? url('/')."/images/photos_bien/".$bien->photosbiens[2]->filename : "")."!#"   //#166 Photo 12
                  .( isset($bien->photosbiens[3]) ? url('/')."/images/photos_bien/".$bien->photosbiens[3]->filename : "")."!#"   //#167 Photo 13
                  .( isset($bien->photosbiens[4]) ? url('/')."/images/photos_bien/".$bien->photosbiens[4]->filename : "")."!#"   //#168 Photo 14
                  .( isset($bien->photosbiens[5]) ? url('/')."/images/photos_bien/".$bien->photosbiens[5]->filename : "")."!#"   //#169 Photo 15
                  .( isset($bien->photosbiens[6]) ? url('/')."/images/photos_bien/".$bien->photosbiens[6]->filename : "")."!#"   //#170 Photo 16
                  .( isset($bien->photosbiens[7]) ? url('/')."/images/photos_bien/".$bien->photosbiens[7]->filename : "")."!#"   //#171 Photo 17
                  .( isset($bien->photosbiens[8]) ? url('/')."/images/photos_bien/".$bien->photosbiens[8]->filename : "")."!#"   //#172 Photo 18
                  .( isset($bien->photosbiens[8]) ? url('/')."/images/photos_bien/".$bien->photosbiens[8]->filename : "")."!#"   //#173 Photo 19
                  .( isset($bien->photosbiens[8]) ? url('/')."/images/photos_bien/".$bien->photosbiens[8]->filename : "")."!#"   //#174 Photo 20
                  ."id_tech".$bien->id."!#"   //#175 Identifiant technique  *************
                  .$bien->xxxxxxxxxx."!#"   //#176 Consommation énergie
                  .$bien->xxxxxxxxxx."!#"   //#177 Bilan consommation énergie
                  .$bien->xxxxxxxxxx."!#"   //#178 Emissions GES
                  .$bien->xxxxxxxxxx."!#"   //#179 Bilan émission GES
                  .$bien->xxxxxxxxxx."!#"   //#180 Identifiant quartier (obsolète)
                  .$bien->xxxxxxxxxx."!#"   //#181 Sous type de bien
                  .$bien->xxxxxxxxxx."!#"   //#182 Périodes de disponibilité
                  .$bien->xxxxxxxxxx."!#"   //#183 Périodes basse saison
                  .$bien->xxxxxxxxxx."!#"   //#184 Périodes haute saison
                  .$bien->xxxxxxxxxx."!#"   //#185 Prix du bouquet
                  .$bien->xxxxxxxxxx."!#"   //#186 Rente mensuelle
                  .$bien->xxxxxxxxxx."!#"   //#187 Age de l’homme
                  .$bien->xxxxxxxxxx."!#"   //#188 Age de la femme
                  .$bien->xxxxxxxxxx."!#"   //#189 Entrée
                  .$bien->xxxxxxxxxx."!#"   //#190 Résidence
                  .$bien->xxxxxxxxxx."!#"   //#191 Parquet
                  .$bien->xxxxxxxxxx."!#"   //#192 Vis-à-vis
                  .$bien->xxxxxxxxxx."!#"   //#193 Transport : Ligne
                  .$bien->xxxxxxxxxx."!#"   //#194 Transport : Station
                  .$bien->xxxxxxxxxx."!#"   //#195 Durée bail
                  .$bien->xxxxxxxxxx."!#"   //#196 Places en salle
                  .$bien->xxxxxxxxxx."!#"   //#197 Monte-charge
                  .$bien->xxxxxxxxxx."!#"   //#198 Quai
                  .$bien->xxxxxxxxxx."!#"   //#199 Nombre de bureaux
                  .$bien->xxxxxxxxxx."!#"   //#200 Prix du droit d’entrée
                  .$bien->xxxxxxxxxx."!#"   //#201 Prix masqué
                  .$bien->xxxxxxxxxx."!#"   //#202 Loyer annuel global
                  .$bien->xxxxxxxxxx."!#"   //#203 Charges annuelles globales
                  .$bien->xxxxxxxxxx."!#"   //#204 Loyer annuel au m2
                  .$bien->xxxxxxxxxx."!#"   //#205 Charges annuelles au m2
                  .$bien->xxxxxxxxxx."!#"   //#206 Charges mensuelles HT
                  .$bien->xxxxxxxxxx."!#"   //#207 Loyer annuel CC
                  .$bien->xxxxxxxxxx."!#"   //#208 Loyer annuel HT
                  .$bien->xxxxxxxxxx."!#"   //#209 Charges annuelles HT
                  .$bien->xxxxxxxxxx."!#"   //#210 Loyer annuel au m2 CC
                  .$bien->xxxxxxxxxx."!#"   //#211 Loyer annuel au m2 HT
                  .$bien->xxxxxxxxxx."!#"   //#212 Charges annuelles au m2 HT
                  .$bien->xxxxxxxxxx."!#"   //#213 Divisible
                  .$bien->xxxxxxxxxx."!#"   //#214 Surface divisible minimale
                  .$bien->xxxxxxxxxx."!#"   //#215 Surface divisible maximale
                  .$bien->xxxxxxxxxx."!#"   //#216 Surface séjour
                  .$bien->xxxxxxxxxx."!#"   //#217 Nombre de véhicules
                  .$bien->xxxxxxxxxx."!#"   //#218 Prix du droit au bail
                  .$bien->xxxxxxxxxx."!#"   //#219 Valeur à l’achat
                  .$bien->xxxxxxxxxx."!#"   //#220 Répartition du chiffre d’affaire
                  .$bien->xxxxxxxxxx."!#"   //#221 Terrain agricole
                  .$bien->xxxxxxxxxx."!#"   //#222 Equipement bébé
                  .$bien->xxxxxxxxxx."!#"   //#223 Terrain constructible
                  .$bien->xxxxxxxxxx."!#"   //#224 Résultat Année N-2
                  .$bien->xxxxxxxxxx."!#"   //#225 Résultat Année N-1
                  .$bien->xxxxxxxxxx."!#"   //#226 Résultat Actuel
                  .$bien->xxxxxxxxxx."!#"   //#227 Immeuble de parkings
                  .$bien->xxxxxxxxxx."!#"   //#228 Parking isolé
                  .$bien->xxxxxxxxxx."!#"   //#229 Si Viager Vendu Libre
                  .$bien->xxxxxxxxxx."!#"   //#230 Logement à disposition
                  .$bien->xxxxxxxxxx."!#"   //#231 Terrain en pente
                  .$bien->xxxxxxxxxx."!#"   //#232 Plan d’eau
                  .$bien->xxxxxxxxxx."!#"   //#233 Lave-linge
                  .$bien->xxxxxxxxxx."!#"   //#234 Sèche-linge
                  .$bien->xxxxxxxxxx."!#"   //#235 Connexion internet
                  .$bien->xxxxxxxxxx."!#"   //#236 Chiffre affaire Année N-2
                  .$bien->xxxxxxxxxx."!#"   //#237 Chiffre affaire Année N-1
                  .$bien->xxxxxxxxxx."!#"   //#238 Conditions financières
                  .$bien->xxxxxxxxxx."!#"   //#239 Prestations diverses
                  .$bien->xxxxxxxxxx."!#"   //#240 Longueur façade
                  .$bien->xxxxxxxxxx."!#"   //#241 Montant du rapport
                  .$bien->xxxxxxxxxx."!#"   //#242 Nature du bail
                  .$bien->xxxxxxxxxx."!#"   //#243 Nature bail commercial
                  .$bien->xxxxxxxxxx."!#"   //#244 Nombre terrasses
                  .$bien->xxxxxxxxxx."!#"   //#245 Prix hors taxes
                  .$bien->xxxxxxxxxx."!#"   //#246 Si Salle à manger
                  .$bien->xxxxxxxxxx."!#"   //#247 Si Séjour
                  .$bien->xxxxxxxxxx."!#"   //#248 Terrain donne sur la rue
                  .$bien->xxxxxxxxxx."!#"   //#249 Immeuble de type bureaux
                  .$bien->xxxxxxxxxx."!#"   //#250 Terrain viabilisé
                  .$bien->xxxxxxxxxx."!#"   //#251 Equipement Vidéo
                  .$bien->xxxxxxxxxx."!#"   //#252 Surface de la cave
                  .$bien->xxxxxxxxxx."!#"   //#253 Surface de la salle à manger
                  .$bien->xxxxxxxxxx."!#"   //#254 Situation commerciale
                  .$bien->xxxxxxxxxx."!#"   //#255 Surface maximale d’un bureau
                  .$bien->xxxxxxxxxx."!#"   //#256 Honoraires charge acquéreur (obsolète)
                  .$bien->xxxxxxxxxx."!#"   //#257 Pourcentage honoraires TTC (obsolète)
                  .$bien->xxxxxxxxxx."!#"   //#258 En copropriété
                  .$bien->xxxxxxxxxx."!#"   //#259 Nombre de lots
                  .$bien->xxxxxxxxxx."!#"   //#260 Charges annuelles
                  .$bien->xxxxxxxxxx."!#"   //#261 Syndicat des copropriétaires en procédure
                  .$bien->xxxxxxxxxx."!#"   //#262 Détail procédure du syndicat des copropriétaires
                  .$bien->xxxxxxxxxx."!#"   //#263 Champ personnalisé 26
                  .( isset($bien->photosbiens[21]) ? url('/')."/images/photos_bien/".$bien->photosbiens[21]->filename : "")."!#"   //#264 Photo 21
                  .( isset($bien->photosbiens[22]) ? url('/')."/images/photos_bien/".$bien->photosbiens[22]->filename : "")."!#"   //#265 Photo 22
                  .( isset($bien->photosbiens[23]) ? url('/')."/images/photos_bien/".$bien->photosbiens[23]->filename : "")."!#"   //#266 Photo 23
                  .( isset($bien->photosbiens[24]) ? url('/')."/images/photos_bien/".$bien->photosbiens[24]->filename : "")."!#"   //#267 Photo 24
                  .( isset($bien->photosbiens[25]) ? url('/')."/images/photos_bien/".$bien->photosbiens[25]->filename : "")."!#"   //#268 Photo 25
                  .( isset($bien->photosbiens[26]) ? url('/')."/images/photos_bien/".$bien->photosbiens[26]->filename : "")."!#"   //#269 Photo 26
                  .( isset($bien->photosbiens[27]) ? url('/')."/images/photos_bien/".$bien->photosbiens[27]->filename : "")."!#"   //#270 Photo 27
                  .( isset($bien->photosbiens[28]) ? url('/')."/images/photos_bien/".$bien->photosbiens[28]->filename : "")."!#"   //#271 Photo 28
                  .( isset($bien->photosbiens[29]) ? url('/')."/images/photos_bien/".$bien->photosbiens[29]->filename : "")."!#"   //#272 Photo 29
                  .( isset($bien->photosbiens[30]) ? url('/')."/images/photos_bien/".$bien->photosbiens[30]->filename : "")."!#"   //#273 Photo 30
                  ."!#"   //#274 Titre photo 10
                  ."!#"   //#275 Titre photo 11
                  ."!#"   //#276 Titre photo 12
                  ."!#"   //#277 Titre photo 13
                  ."!#"   //#278 Titre photo 14
                  ."!#"   //#279 Titre photo 15
                  ."!#"   //#280 Titre photo 16
                  ."!#"   //#281 Titre photo 17
                  ."!#"   //#282 Titre photo 18
                  ."!#"   //#283 Titre photo 19
                  ."!#"   //#284 Titre photo 20
                  ."!#"   //#285 Titre photo 21
                  ."!#"   //#286 Titre photo 22
                  ."!#"   //#287 Titre photo 23
                  ."!#"   //#288 Titre photo 24
                  ."!#"   //#289 Titre photo 25
                  ."!#"   //#290 Titre photo 26
                  ."!#"   //#291 Titre photo 27
                  ."!#"   //#292 Titre photo 28
                  ."!#"   //#293 Titre photo 29
                  ."!#"   //#294 Titre photo 30
                  ."!#"   //#295 Prix du terrain
                  ."!#"   //#296 Prix du modèle de maison
                  ."!#"   //#297 Nom de l'agence gérant le terrain
                  ."!#"   //#298 Latitude
                  ."!#"   //#299 Longitude
                  ."!#"   //#300 Précision GPS
                  ."4.08-006!#"   //#301 Version Format
                  ."1!#"   //#302 Honoraires à la charge de
                  ."1200000!#"   //#303 Prix hors honoraires acquéreur
                  ."1!#"   //#304 Modalités charges locataire   ***********
                  ."!#"   //#305 Complément loyer
                  ."300!#"   //#306 Part honoraires état des lieux
               )
               );
               
            }
        }
        
       //  dd($list);
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        
        fclose($fp);
       // dd($users_biens);

}

    
/** Fonction d'export pour stylimmo
    * @author jean-philippe
    * @return \Illuminate\Http\Response
    **/	
    public function exportPrestigeBelleDemeurre($users_biens){
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
   
        // dd($users_biens);
        xmlwriter_start_element($xw,"hektor");

                foreach($users_biens as $user_biens){ 

                    foreach($user_biens[1] as $bien){
                        xmlwriter_start_element($xw,"ad");
                        
                            xmlwriter_start_element($xw,"id");

                                xmlwriter_start_attribute($xw,"dateEnr");                        
                                    xmlwriter_text($xw, $bien->created_at);
                                xmlwriter_end_attribute($xw);
                                xmlwriter_start_attribute($xw,"dateMaj");                        
                                    xmlwriter_text($xw, $bien->updated_at);
                                xmlwriter_end_attribute($xw);
                                xmlwriter_start_attribute($xw,"mandateKey");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);                                
                                
                                xmlwriter_text($xw, $bien->id);
                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"reference_client","");
                            $this->add_element_cdata($xw,"titre",$bien->titre_annonce);
                            $this->add_element_cdata($xw,"reference",$bien->numero_dossier);

                            // agence
                            xmlwriter_start_element($xw,"agence");                            
                                xmlwriter_start_attribute($xw,"siret");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw); 
                                xmlwriter_start_attribute($xw,"url");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);
                                xmlwriter_start_attribute($xw,"type");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);
                                                          
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, $user_biens[0]->nom.' '.$user_biens[0]->prenom);
                                xmlwriter_end_cdata($xw);

                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"type_offre", $bien->type_offre);
                            $this->add_element($xw,"type_offre_code",0); // Avoir la liste des types offre
                            $this->add_element($xw,"agenceLogo","http://stylimmo.la-boite-immo.com/images/logoadmin.jpg");

                            //agenceLocation
                            xmlwriter_start_element($xw,"agenceLocation");                            
                                xmlwriter_start_attribute($xw,"cp");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw); 
                                xmlwriter_start_attribute($xw,"latitude");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);
                                xmlwriter_start_attribute($xw,"longitude");                        
                                    xmlwriter_text($xw, "");
                                xmlwriter_end_attribute($xw);
                                                        
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, "115 avenue de la roquette  bagnols sur ceze");
                                xmlwriter_end_cdata($xw);
                            xmlwriter_end_element($xw);

                            //agenceVille
                            xmlwriter_start_element($xw,"agenceVille");
                                xmlwriter_start_attribute($xw,"cp");                        
                                    xmlwriter_text($xw, "30200");
                                xmlwriter_end_attribute($xw);                            
                                                        
                            
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, "bagnols sur ceze");
                                xmlwriter_end_cdata($xw);
                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"cle_agence","stylimmo_".$user_biens[0]->id);
                            $this->add_element_cdata($xw,"telephone",$user_biens[0]->telephone);
                            $this->add_element_cdata($xw,"email",$user_biens[0]->email);
                            $this->add_element_cdata($xw,"corps", $bien->description_annonce);
                            $this->add_element_cdata($xw,"corps_impression",$bien->description_annonce);
                            $this->add_element($xw,"prix",$bien->prix_public);

                            $this->add_element_cdata($xw,"urlBaremeHono","http://www.stylimmo.com/bareme.php");
                            $this->add_element_cdata($xw,"honorairesPourcentageAcquereur","xxx");
                            $this->add_element($xw,"prixnetvendeur", $bien->prix_prive );
                            $this->add_element_cdata($xw,"url","xxx");
                            $this->add_element_cdata($xw,"numero_mandat",(isset ($bien->mandat_ok) ? $bien->mandat_ok->numero : ""));
                            $this->add_element($xw,"type_mandat", ( isset ($bien->mandat_ok) ? $bienn->mandat_ok->type : ""));
                            $this->add_element($xw,"datedebut_mandat",( isset ($bien->mandat_ok) ? $bien->mandat_ok->date_debut : ""));
                            $this->add_element($xw,"datefin_mandat",( isset ($bien->mandat_ok) ? $bien->mandat_ok->date_fin : ""));
                            $this->add_element_cdata($xw,"type_bien", $bien->type_bien);
                            $this->add_element($xw,"type_bien_code","55");   // Obtenir la liste des code de type 

                            xmlwriter_start_element($xw,"surface_habitable");
                                xmlwriter_start_attribute($xw,"unit");                        
                                    xmlwriter_text($xw, "meters");
                                xmlwriter_end_attribute($xw);                        
                                                        
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, $bien->surface_habitable);
                                xmlwriter_end_cdata($xw);

                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"surface_terrain",$bien->surface_terrain);
                            $this->add_element_cdata($xw,"nb_pieces",$bien->nombre_piece);
                            $this->add_element_cdata($xw,"chambres",$bien->nombre_chambre);
                            $this->add_element_cdata($xw,"sdb",$bien->nb_salle_bain_agencement_interieur);
                            $this->add_element_cdata($xw,"cuisine",$bien->cuisine_etat_agencement_interieur);
                            $this->add_element_cdata($xw,"chauffage","");
                            $this->add_element_cdata($xw,"energie_chauffage","");
                            $this->add_element_cdata($xw,"format_chauffage","");

                            xmlwriter_start_element($xw,"chauffages");
                                xmlwriter_start_element($xw,"chauffage");
                                $this->add_element($xw,"type_chauffage","");
                                $this->add_element($xw,"energie_chauffage","");
                                $this->add_element($xw,"format_chauffage","");
                                xmlwriter_end_element($xw);
                            xmlwriter_end_element($xw);

                            $this->add_element($xw,"parking",$bien->parking_interieur_agencement_exterieur);
                            $this->add_element($xw,"piscine","");
                            $this->add_element($xw,"jardin","");
                            $this->add_element($xw,"terrasse",$bien->nombre_terrasse_agencement_exterieur);
                            $this->add_element($xw,"prestige","");
                            $this->add_element_cdata($xw,"annee_construction","xxx");

                            $this->add_element_cdata($xw,"annee_construction",$bien->annee_construction_diagnostic);
                            $this->add_element($xw,"dpe_non_concerne","");


                            $this->add_element($xw,"dpe_vierge", ($bien->dpe_vierge_diagnostic === "on") ? 1: 0);
                      
                            xmlwriter_start_element($xw,"pays");
                                xmlwriter_start_attribute($xw,"ISO");                        
                                    xmlwriter_text($xw,  ($bien->pays_annonce_secteur === "Espagne") ? "ES":"FR"); 
                                xmlwriter_end_attribute($xw);                        
                                                        
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, $bien->pays_annonce_secteur);
                                xmlwriter_end_cdata($xw);
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw,"ville");
                                xmlwriter_start_attribute($xw,"humanName");                        
                                    xmlwriter_text($xw,  $bien->ville); 
                                xmlwriter_end_attribute($xw);                        
                                                        
                                xmlwriter_start_cdata($xw);
                                    xmlwriter_text($xw, $bien->ville);
                                xmlwriter_end_cdata($xw);
                            xmlwriter_end_element($xw);
                            $this->add_element_cdata($xw,"cp",$bien->code_postal);
                           
                            $this->add_element($xw,"departement","");
                            $this->add_element($xw,"coup_de_coeur",""); // partie à implémenter
                           
                            xmlwriter_start_element($xw,"images");

                            foreach ($bien->photosbiens as $photo){ 
                                if($photo->visibilite =="visible"){ 
                                    $this->add_element_cdata($xw,"image",url('/')."/images/photos_bien/".$photo->filename); 
                                } 
                            }
                            xmlwriter_end_element($xw);

                            $this->add_element_cdata($xw,"status","");
                            $this->add_element($xw,"meuble", ($bien->meuble_agencement_interieur === "Non") ? 0:1);

                        // fin ad
                        xmlwriter_end_element($xw);
                        
                    }
                }

        xmlwriter_end_element($xw);
  
        //Fin  du document
    xmlwriter_end_document($xw);  


        file_put_contents ($this->passerelles_path.'/prestige-belle-demeurre.xml',xmlwriter_output_memory($xw));        
    // dd( xmlwriter_output_memory($xw) );
                $this->sendfile();
}




public function sendfile(){
    // connect and login to FTP server
    $ftp_server = "web1.1genei.fr";
    $ftp_username = "stylimmo-www";
    $ftp_userpass = "Clwjrl88t99y";
    $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
    $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

    $file = $this->passerelles_path.'/stylimmo-outil.xml';

    // upload file
    if (ftp_put($ftp_conn, "/stylimmo-outil.xml", $file, FTP_ASCII))
    {
    echo "Téléchargement réussi $file.";
    }
    else
    {
    echo "Erreur de téléchargement $file.";
    }

    // close connection
    ftp_close($ftp_conn);
}


/** Fonction de xxxxxxxxxxxxxx
* @author jean-philippe
* @param  App\Models\PhotosBien
* @return \Illuminate\Http\Response
**/	
    public function code_type($type){

        $code_type = array();

        switch ($type) {
            // Maison
            case 'Château':
                $code_type = array(1241,"Château");
                break;
            case 'Ferme':
                 $code_type = array(1263,"Ferme");
                break;
            case 'Maison':
                $code_type = array(1200,"Maison");
                break;
            case 'Maison de village':
                $code_type = array(1214,"Maison de village");
                break;
            case 'Mas':
                $code_type = array(1216,"Mas");
                break;
            case 'Propriété':
                $code_type = array(1240,"Propriété");
                break;
            case 'Maison de village':
                $code_type = array(1214,"Maison de village");
                break;
            case 'Villa':
                $code_type = array(1213,"Villa");
                break;
            // Appartement
            case 'Duplex':
                $code_type = array(1192,"Duplex/Triplex");
                break;
            case 'Triplex':
                $code_type = array(1192,"Duplex/Triplex");
                break;
            case 'Immeuble':
                $code_type = array(1500,"Immeuble");
                break;
            case 'Loft':
                $code_type = array(1191,"Loft");
                break;
            case 'Studio':
                $code_type = array(1132,"Studio");
                break;
            case 'Immeuble':
                $code_type = array(1500,"Immeuble");
                break;
            // Terrain
            case 'Terrain':
                $code_type = array(1300,"Terrain");
                break;
            // Autre
            case 'Cabanon':
                $code_type = array(1903,"Cabanon");
                break;
            case 'Cave':
                $code_type = array(1901,"Cave");
                break;
            case 'Chalet':
                $code_type = array(1218,"Chalet");
                break;
            case 'Garage':
                $code_type = array(1420,"Garage/box");
                break;
            case 'Parking':
                $code_type = array(1410,"Parking");
                break;
            case 'Autre':
                $code_type = array(1190,"Autre");
                break;
            default:
                $code_type = array(1190,"Autre");
                break;
              
        }

        return $code_type;
    }


}
