<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acquereur;
use App\Models\Groupeacquereur;

class AcquereurController extends Controller
{

    /*belkacem*/
    public function personne_seule()
    {
        $ret = "piece_identite:aps01:0&accord_pret_bancaire:aps02:0&rib:aps03:0&livret_famille:aps04:0&avis_imposition:aps05:0&justificatif_domicile:aps06:0";
        return $ret;
    }

    public function couple()
    {
        $ret = "piece_identite:acpl01:0&accord_pret_bancaire:acpl02:0&rib:acpl03:0&livret_famille:acpl04:0&avis_imposition:acpl05:0&justificatif_domicile:acpl06:0&acte_mariage:acpl07:0";
        return $ret;
    }

    public function personne_morale()
    {
        $ret = "piece_identite:apm01:0&accord_pret_bancaire:apm02:0&rib:apm03:0&livret_famille:apm04:0&avis_imposition:apm05:0&justificatif_domicile:apm06:0&kbis:apm07:0";
        return $ret;
    }

    /** determine les pieces justificatives selon le type de l'acquereur.
    *
    * @author: belkacem
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    **/
    public function acquereur_doc_serialization(Acquereur $acquereur)
    {
        if ($acquereur->type == "personne_seule")
            $acquereur->serialize_doc_justificatif = $this->personne_seule();
        if ($acquereur->type == "couple")
            $acquereur->serialize_doc_justificatif = $this->couple();
        if ($acquereur->type == "personne_morale")
            $acquereur->serialize_doc_justificatif = $this->personne_morale();
    }
    /*belkacem*/ 

/** 
 * Gestions des acquereurs.
 * 
 * @author jean-philippe
 * @return \Illuminate\Http\Response
*/
    public function index(){

        $acquereurs_seuls = Acquereur::where('type','personne_seule')->get();
        $acquereurs_couples = Acquereur::where('type','couple')->get();
        $acquereurs_morales = Acquereur::where('type','personne_morale')->get();
        $groupes = Groupeacquereur::all();

        return view('acquereurs.index', compact('acquereurs_seuls','acquereurs_couples','acquereurs_morales','groupes'));
        
    }


/** 
 * Formulaire d'ajout d'un acquereur.
 * @author jean-philippe
 * @return \Illuminate\Http\Response
*/   
    public function create(){

        $acquereur_seuls = Acquereur::where("type","personne_seule")->get();
        $emails_acquereur = Acquereur::all()->pluck('email');
        $noms_groupes = Groupeacquereur::all()->pluck('nom_groupe');


        return view('acquereurs.add',compact("acquereur_seuls","emails_acquereur","noms_groupes"));
    }
     

/**  
 * Afficher le detail d'un acquereur
 * 
 * @author jean-philippe
 * @param  App\Models\Acquereur $acquereur
 * @return \Illuminate\Http\Response
*/  
    public function show(Acquereur $acquereur){

        return view('acquereurs.detail', compact('acquereur'));
    }
    

/**  
 * Afficher le detail d'un groupe d'acquereurs
 * 
 * @author jean-philippe
 * @param  App\Models\Groupeacquereur $groupe
 * @return \Illuminate\Http\Response
*/  
    public function showGroupe(Groupeacquereur $groupe){

        return view('compenents.acquereurs.detailSuccession', compact('groupe'));
    }

/**  
 * ajout d'un  acquereurs 
 * 
 * @author jean-philippe
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
*/ 
    public function store(Request $request){

        if( $request['type_acquereur'] == "personne_seule"){
             
            Acquereur::create([
                "type" => $request['type_acquereur'],
                "user_id" => auth()->id(),
                "civilite" => $request['civilite'],
                "nom" => $request['nom'],
                "prenom" => $request['prenom'],
                "categorie" => $request['categorie'],
                "email" => $request['email'],
                "source_contact" => $request['source_contact'],
                "email" => $request['email'],
                "telephone_fixe" => $request['telephone_fixe'],
                "telephone_mobile" => $request['telephone_mobile'],
                "adresse" => $request['adresse'],
                "code_postal" => $request['code_postal'],
                "ville" => $request['ville'],
                "pays" => $request['pays'],
                "date_naissance" => $request['date_naissance'],
                "lieu_naissance" => $request['lieu_naissance'],
                "langue" => $request['langue'],
                "note" => $request['note']
            ]);
        }
        elseif($request['type_acquereur'] == "couple"){

            Acquereur::create([
                "type" => $request['type_acquereur'],
                "user_id" => auth()->id(),
                "civilite" => $request['civilite1'],
                "nom" => $request['nom1'],
                "prenom" => $request['prenom1'],
                "categorie" => $request['categorie1'],
                "email" => $request['email1'],
                "source_contact" => $request['source_contact'],
                "telephone_fixe" => $request['telephone_fixe1'],
                "telephone_mobile" => $request['telephone_mobile1'],
                "adresse" => $request['adresse1'],
                "code_postal" => $request['code_postal1'],
                "ville" => $request['ville1'],
                "pays" => $request['pays1'],
                "date_naissance" => $request['date_naissance1'],
                "lieu_naissance" => $request['lieu_naissance1'],
                "langue" => $request['langue1'],
                "note" => $request['note1'],

                "civilite_partenaire" => $request['civilite2'],
                "nom_partenaire" => $request['nom2'],
                "prenom_partenaire" => $request['prenom2'],
                "email_partenaire" => $request['email2'],
                "telephone_fixe_partenaire" => $request['telephone_fixe2'],
                "telephone_mobile_partenaire" => $request['telephone_mobile2'],
                "adresse_partenaire" => $request['adresse2'],
                "code_postal_partenaire" => $request['code_postal2'],
                "ville_partenaire" => $request['ville2'],
                "pays_partenaire" => $request['pays2'],
                "date_naissance_partenaire" => $request['date_naissance2'],
                "lieu_naissance_partenaire" => $request['lieu_naissance2'],
                "langue_partenaire" => $request['langue2'],
                "note_partenaire" => $request['note2']
            ]);

        }
        elseif($request['type_acquereur'] == "personne_morale"){
            // dd($request);
            $request->validate([
                
                "forme_juridique_pm" => "string|required",
                "raison_sociale_pm" => "string|required",
                "document_justificatif" => "file:pdf,jpg,png|max:15000",
            ]);

            $acquereur = new Acquereur;
            $newacquereur =  $acquereur->create([
                            "type" => $request['type_acquereur'],
                            "user_id" => auth()->id(),
                            "forme_juridique" => $request['forme_juridique_pm'],
                            "raison_sociale" => $request['raison_sociale_pm'],
                            "telephone_fixe" => $request['telephone_fixe_pm'],
                            "telephone_mobile" => $request['telephone_mobile_pm'],
                            "email" => $request['email_pm'],               
                            "adresse" => $request['adresse_pm'],
                            "code_postal" => $request['code_postal_pm'],
                            "ville" => $request['ville_pm'],
                            "pays" => $request['pays_pm'],
                            "siret" => $request['siret_pm'],
                            "source_contact" => $request['source_contact_pm'],
                            "note" => $request['note_pm']        
                                   
                        ]);
           
                        // sauvegarde du document
            $chemin = $this->saveDocument($request, $newacquereur, "document_justificatif", "doc_justificatif"  );
            $newacquereur->document_justificatif = $chemin;
            $newacquereur->update();

            $lastInsertId = $newacquereur->id;



                        if(isset($request['contacts_associes_nom'])){
                            // $acquereur->acquereurs_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                            $count = 0;
                            foreach($request['contacts_associes_nom'] as $contact_id){

                                $acquereur->add_acquereur($lastInsertId, $contact_id,$request['contacts_associes_titre'][$count]);
                                $count ++;
                            }
                            
                            
                        }

                        if(isset($request['type_acquereur_send'])){
                            // $acquereur->acquereurs_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                            $count1 = 0;

                            for ($i = 0; $i < count($request['type_acquereur_send']); $i++){                              
                                //$acquereur->add_acquereur($lastInsertId, $contact,$request['contacts_associes_titre'][$count]);

                                $newacquereu =  Acquereur::create([
                                    "type" => "personne_seule",
                                    "user_id" => auth()->id(),
                                    "civilite" => $request['civilite_nc_send'][$i],
                                    "nom" => $request['nom_nc_send'][$i],
                                    "prenom" => $request['prenom_nc_send'][$i],
                                    "email" => $request['email_nc_send'][$i],
                                    "source_contact" => $request['source_contact_nc_send'][$i],
                            
                                    "telephone_fixe" => $request['telephone_fixe_nc_send'][$i],
                                    "telephone_mobile" => $request['telephone_mobile_nc_send'][$i],
                                    "adresse" => $request['adresse_nc_send'][$i],
                                    "code_postal" => $request['code_postal_nc_send'][$i],
                                    "ville" => $request['ville_nc_send'][$i],
                                    "pays" => $request['pays_nc_send'][$i],
                                ]);

                                $acquereur->add_acquereur($lastInsertId, $newacquereu->id,$request['contacts_associes_titre'][$i]);

                            }

                        }
                    
        }
        elseif($request['type_acquereur'] == "succession_personne"){
           
            $newgroupe = Groupeacquereur::create([
                "nom_groupe"=>$request['nom_groupe'],
                "user_id" => auth()->id(),
            ]);

            if(isset($request['acquereurs_ajoute_id'])){
                // $acquereur->acquereurs_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                $count = 0;
                // $acque = Acquereur::where('id',7)->firstorfail();
                //  dd($acque);
                foreach($request['acquereurs_ajoute_id'] as $acquereur_id){
                    $acque = Acquereur::where('id',$acquereur_id)->firstorfail();
                    
                    $acque->add_groupeacquereur($acquereur_id, $newgroupe->id);
                    $count ++;
                }
            }

            if(isset($request['type_acquereur_send'])){
                // $acquereur->acquereurs_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                $count1 = 0;

                for ($i = 0; $i < count($request['type_acquereur_send']); $i++){                              
                    
                    $newacquereu =  Acquereur::create([
                        "type" => "personne_seule",
                        "user_id" => auth()->id(),
                        "civilite" => $request['civilite_succession_send'][$i],
                        "nom" => $request['nom_succession_send'][$i],
                        "prenom" => $request['prenom_succession_send'][$i],
                        "email" => $request['email_succession_send'][$i],
                        "source_contact" => $request['source_contact_succession_send'][$i],
                                     
                        "telephone_fixe" => $request['telephone_fixe_succession_send'][$i],
                        "telephone_mobile" => $request['telephone_mobile_succession_send'][$i],
                        "adresse" => $request['adresse_succession_send'][$i],
                        "code_postal" => $request['code_postal_succession_send'][$i],
                        "ville" => $request['ville_succession_send'][$i],
                        "pays" => $request['pays_succession_send'][$i],
                    ]);

                    $newacquereu->add_groupeacquereur($newacquereu->id, $newgroupe->id);

                }

            }

        }
        

        
         return back()->with('ok', __("Nouvel acquereur ajouté"));
    }

 
/**  
 * Modification d'un  acquereur 
 * 
 * @author jean-philippe
 * @param  \Illuminate\Http\Request  $request
 * @param  App\Models\Acquereur
 * @return \Illuminate\Http\Response
*/ 
        public function update(Request $request,Acquereur $acquereur){
    
        
    
            if( $request['type_acquereur'] == "personne_seule"){
                    
                $acquereur->type=$request['type_acquereur'];
                $acquereur->civilite=$request['civilite'];
                $acquereur->nom=$request['nom'];
                $acquereur->prenom=$request['prenom'];
                $acquereur->categorie=$request['categorie'];
                $acquereur->email=$request['email'];
                $acquereur->source_contact=$request['source_contact'];
                $acquereur->telephone_fixe=$request['telephone_fixe'];
                $acquereur->telephone_mobile=$request['telephone_mobile'];
                $acquereur->adresse=$request['adresse'];
                $acquereur->code_postal=$request['code_postal'];
                $acquereur->ville=$request['ville'];
                $acquereur->pays=$request['pays'];
                $acquereur->date_naissance= $request['date_naissance'];
                $acquereur->lieu_naissance=$request['lieu_naissance'];
                $acquereur->langue=$request['langue'];
                $acquereur->note=$request['note'];

                $acquereur->update();
                
                
            }
            elseif($request['type_acquereur'] == "couple"){
    
                $acquereur->type=$request['type_acquereur'];
                $acquereur->civilite=$request['civilite1'];
                $acquereur->nom=$request['nom1'];
                $acquereur->prenom=$request['prenom1'];
                $acquereur->categorie=$request['categorie1'];
                $acquereur->email=$request['email1'];
                $acquereur->source_contact=$request['source_contact'];
                $acquereur->telephone_fixe=$request['telephone_fixe1'];
                $acquereur->telephone_mobile=$request['telephone_mobile1'];
                $acquereur->adresse=$request['adresse1'];
                $acquereur->code_postal=$request['code_postal1'];
                $acquereur->ville=$request['ville1'];
                $acquereur->pays=$request['pays1'];
                $acquereur->date_naissance=$request['date_naissance1'];
                $acquereur->lieu_naissance=$request['lieu_naissance1'];
                $acquereur->langue=$request['langue1'];
                $acquereur->note=$request['note1'];
                $acquereur->civilite_partenaire=$request['civilite2'];
                $acquereur->nom_partenaire=$request['nom2'];
                $acquereur->prenom_partenaire=$request['prenom2'];
                $acquereur->email_partenaire=$request['email2'];
                $acquereur->telephone_fixe_partenaire=$request['telephone_fixe2'];
                $acquereur->telephone_mobile_partenaire=$request['telephone_mobile2'];
                $acquereur->adresse_partenaire=$request['adresse2'];
                $acquereur->code_postal_partenaire=$request['code_postal2'];
                $acquereur->ville_partenaire=$request['ville2'];
                $acquereur->pays_partenaire=$request['pays2'];
                $acquereur->date_naissance_partenaire=$request['date_naissance2'];
                $acquereur->lieu_naissance_partenaire=$request['lieu_naissance2'];
                $acquereur->langue_partenaire=$request['langue2'];
                $acquereur->note_partenaire=$request['note2'];
                
                $acquereur->update();
    
            }
            elseif($request['type_acquereur'] == "personne_morale"){
                
                $request->validate([
                    
                    "forme_juridique_pm" => "string|required",
                    "raison_sociale_pm" => "string|required",
                    "document_justificatif" => "file:pdf,jpg,png|max:15000",
                ]);

                $acquereur->type=$request['type_acquereur'];
                $acquereur->forme_juridique=$request['forme_juridique_pm'];
                $acquereur->raison_sociale=$request['raison_sociale_pm'];
                $acquereur->telephone_fixe=$request['telephone_fixe_pm'];
                $acquereur->telephone_mobile=$request['telephone_mobile_pm'];
                $acquereur->email=$request['email_pm'];
                $acquereur->adresse=$request['adresse_pm'];
                $acquereur->code_postal=$request['code_postal_pm'];
                $acquereur->ville=$request['ville_pm'];
                $acquereur->pays=$request['pays_pm'];
                $acquereur->siret=$request['siret_pm'];
                $acquereur->source_contact=$request['source_contact_pm'];
                $acquereur->note=$request['note_pm'];
                
                $acquereur->update();


    
               
                            // sauvegarde du document
                // $chemin = $this->saveDocument($request, $newacquereur, "document_justificatif", "doc_justificatif"  );
                // $newacquereur->document_justificatif = $chemin;
                // $newacquereur->update();
    
                 $lastInsertId = $acquereur->id;
    
    
    
                            if(isset($request['contacts_associes_nom'])){
                                // $acquereur->acquereurs_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                                $count = 0;
                                foreach($request['contacts_associes_nom'] as $contact_id){
    
                                    $acquereur->add_acquereur($lastInsertId, $contact_id,$request['contacts_associes_titre'][$count]);
                                    $count ++;
                                }
                                
                                
                            }
    
                            if(isset($request['type_acquereur_send'])){
                                // $acquereur->acquereurs_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                                $count1 = 0;
    
                                for ($i = 0; $i < count($request['type_acquereur_send']); $i++){                              
                                    //$acquereur->add_acquereur($lastInsertId, $contact,$request['contacts_associes_titre'][$count]);
    
                                    $newacquereu =  Acquereur::create([
                                        "type" => "personne_seule",
                                        "civilite" => $request['civilite_nc_send'][$i],
                                        "nom" => $request['nom_nc_send'][$i],
                                        "prenom" => $request['prenom_nc_send'][$i],
                                        "email" => $request['email_nc_send'][$i],
                                        "source_contact" => $request['source_contact_nc_send'][$i],
                                        "telephone_fixe" => $request['telephone_fixe_nc_send'][$i],
                                        "telephone_mobile" => $request['telephone_mobile_nc_send'][$i],
                                        "adresse" => $request['adresse_nc_send'][$i],
                                        "code_postal" => $request['code_postal_nc_send'][$i],
                                        "ville" => $request['ville_nc_send'][$i],
                                        "pays" => $request['pays_nc_send'][$i],
                                    ]);
    
                                    $acquereur->add_acquereur($lastInsertId, $newacquereu->id,$request['contacts_associes_titre'][$i]);
    
                                }
    
                            }
                        
            }

             return back()->with('ok', __("Ce acquereur a été modifié"));
        }
        

/**  
 * Modification d'un groupe d'acquereurs 
 * 
 * @author jean-philippe
 * @param  \Illuminate\Http\Request  $request
 * @param  App\Models\Acquereur
 * @return \Illuminate\Http\Response
*/ 
    public function updateGroupe(Request $request,Groupeacquereur $groupe){           
    
            $groupe->nom_groupe = $request['nom_groupe'];
            $groupe->update();
           
            if(isset($request['acquereurs_ajoute_id'])){
               
                foreach($request['acquereurs_ajoute_id'] as $membre_id){

                    $groupe->add_acquereurs($membre_id, $groupe->id);
                   
                }
            }

        // dd($groupe->acquereurs);

            if(isset($request['type_acquereur_send'])){
                // $acquereur->acquereurs_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                $count1 = 0;

                for ($i = 0; $i < count($request['type_acquereur_send']); $i++){                              
                    //$acquereur->add_acquereur($lastInsertId, $contact,$request['contacts_associes_titre'][$count]);

                    $newacquereu =  Acquereur::create([
                        "type" => "personne_seule",
                        "civilite" => $request['civilite_succession_send'][$i],
                        "nom" => $request['nom_succession_send'][$i],
                        "prenom" => $request['prenom_succession_send'][$i],
                        "email" => $request['email_succession_send'][$i],
                        "source_contact" => $request['source_contact_succession_send'][$i],
                        "telephone_fixe" => $request['telephone_fixe_succession_send'][$i],
                        "telephone_mobile" => $request['telephone_mobile_succession_send'][$i],
                        "adresse" => $request['adresse_succession_send'][$i],
                        "code_postal" => $request['code_postal_succession_send'][$i],
                        "ville" => $request['ville_succession_send'][$i],
                        "pays" => $request['pays_succession_send'][$i],
                    ]);

                    $groupe->add_acquereurs($newacquereu->id, $groupe->id);
                }

            }
        
            

             return back()->with('ok', __("Ce groupe a été modifié"));
        }




/** 
 *  Dissocier un acquereur
 * 
 * @author jean-philippe
 * @param  App\Models\Acquereur acquereur_morale
 * @param  int $associe_id 
**/ 
    public function dissocier(Acquereur $acquereur_morale, $associe_id){

        $acquereur_morale->detache_acquereur($associe_id);
    }
    
     
/** 
 * Supprimer un membre d'un groupe
 * 
 * @author jean-philippe
 * @param  App\Models\Groupeacquereur $groupe
 * @param  int $membre_id
*/ 
    public function retirerMembre(Groupeacquereur $groupe, $membre_id){

        $groupe->detache_acquereurs($membre_id);
    }

/** Suppression d'un acquereur
*
* @author jean-philippe
* @param  App\Models\Acquereur
**/ 
    public function delete(Acquereur $acquereur){

        $acquereur->delete();
    }


/** Suppression d'un groupe d'acquereur
*
* @author jean-philippe
* @param  \Illuminate\Http\Request  $request
* @param  App\Models\Groupeacquereur
**/ 
     public function deleteGroupe(Groupeacquereur $groupe){

        $groupe->delete();
    }



/**
 *  affichage du formulaire de modifcation d'un acquereur
 * 
 * @author jean-philippe
 * @param  App\Models\Acquereur $acquereur
 * @return \Illuminate\Http\Response
**/ 
    public function edit(Acquereur $acquereur){


        $acquereurs_moraux = Acquereur::where('type','personne_morale')->get();
        $acquereurs_seuls = Acquereur::where('type','personne_seule')->get();

        // Liste des id des acquereurs seuls deja associés à une personne morale
        $id_acquereurs_seuls_deja_assoc = array(); 

        // objet de type acquereur, liste des acquereurs seuls non associé à une personne morale        
        $acquereur_non_associe = array(); 
  

        // dans ce bloc on reccupere les id des acquereurs dejà associé à une personne morale
        foreach($acquereurs_moraux as $acquereur_moral){

            foreach($acquereur_moral->acquereurs_associe as $associe){
                 
                array_push($id_acquereurs_seuls_deja_assoc,$associe->pivot->acquereur_assoc_id);
            }
        }

        // Dans ce bloc, on reccupere les acquereurs qui ne sont pas encore associé à une personne morale
        foreach($acquereurs_seuls as $acquereur_seul){
            if( !in_array( $acquereur_seul->id, $id_acquereurs_seuls_deja_assoc) ){
                 array_push($acquereur_non_associe,  $acquereur_seul ); 
            }
        }
      

      // on envoie à la vue l'acquereur à modifier et la liste des acquereur non associé afin de pouvoir 
      // les associer aux acquereurs moraux

         $emails_acquereur = Acquereur::all()->pluck('email');

        return view('acquereurs.edit',compact('acquereur','acquereur_non_associe','emails_acquereur'));
    }



/** 
 * affichage du formulaire de modifcation d'un groupe d'acquereurs
 * 
 * @author jean-philippe
 * @param  App\Models\Groupeacquereur $groupe
 * @return \Illuminate\Http\Response
**/ 
        public function editGroupe(Groupeacquereur $groupe){

           // les Id des membre du groupe
            $id_acquereurs_membres = array();

            // objet de type acquereur, liste des acquereurs déjà associés à ce groupe      
            $acquereur_non_membres = array(); 

            // Liste de tous les acquereurs
            $acquereurs = Acquereur::All();
           
            foreach($groupe->acquereurs as $membre){
                array_push($id_acquereurs_membres, $membre->id) ;
            }

            foreach($acquereurs as $acquereur){
               if(!in_array($acquereur->id, $id_acquereurs_membres)){
                    array_push($acquereur_non_membres, $acquereur);
               }
            }           
      
          
    
          // on envoie à la vue l'acquereur à modifier et la liste des acquereur non associé afin de pouvoir 
          // les associer aux acquereurs moraux
    
             $emails_acquereur = Acquereur::all()->pluck('email');
             $noms_groupes = Groupeacquereur::all()->pluck('nom_groupe');
    
            return view('compenents.acquereurs.editGroupe',compact('groupe','acquereur_non_membres','emails_acquereur','noms_groupes'));
        }


/** 
 * Fonction de sauvegarde de documents
 * 
 * @author jean-philippe
 * @param  \Illuminate\Http\Request  $request
 * @param  App\Models\Acquereur $acqureur
 * @param  String $file
 * @param  String $fileType
 * @return \Illuminate\Http\Response
**/ 
    public function saveDocument( $request, Acquereur $acqureur, $file, $fileType  ){

        if($request->hasFile($file)){

            $file = $request->file($file);
            $extention ='.'.$file->getClientOriginalExtension();
            $filename =  time().'_'.$fileType.$extention;
            $folder = $acqureur->id.'_'.$acqureur->raison_sociale;
            
            
            
            $path =$file->storeAs(
                $folder, $filename, 'acquereur'
            );
        return $folder."/".$filename;
        }

        return 0;
        
    }



/** 
 * Fonction de téléchargement de document
 * 
 * @author jean-philippe
 * @param  App\Models\Acquereur $acquereur
 * @return \Illuminate\Http\Response
**/ 
    public function getDocument(Acquereur $acquereur){

        $path = storage_path('app\documents\acquereurs\\'.$acquereur->document_justificatif) ;
        return response()->download($path);
    }
}
