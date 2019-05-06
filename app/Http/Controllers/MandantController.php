<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mandant;
use App\Models\Groupemandant;


class MandantController extends Controller
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

    /** determine les pieces justificatives selon le type du mandant.
    *
    * @author: belkacem
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    **/
    public function acquereur_doc_serialization(Mandant $mandant)
    {
        if ($mandant->type == "personne_seule")
            $mandant->serialize_doc_justificatif = $this->personne_seule();
        if ($mandant->type == "couple")
            $mandant->serialize_doc_justificatif = $this->couple();
        if ($mandant->type == "personne_morale")
            $mandant->serialize_doc_justificatif = $this->personne_morale();
    }
    /*belkacem*/ 

/** Gestions des mandants
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function index(){

        $mandants_seuls = Mandant::where('type','personne_seule')->get();
        $mandants_couples = Mandant::where('type','couple')->get();
        $mandants_morales = Mandant::where('type','personne_morale')->get();
        $groupes = Groupemandant::all();

        return view('mandants.index', compact('mandants_seuls','mandants_couples','mandants_morales','groupes'));
        
    }

   
/** Formulaire d'ajout d'un mandant 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/    
    public function create(){

        $mandant_seuls = Mandant::where("type","personne_seule")->get();
        $emails_mandant = Mandant::all()->pluck('email');
        $noms_groupes = Groupemandant::all()->pluck('nom_groupe');

        return view('mandants.add',compact("mandant_seuls","emails_mandant","noms_groupes"));
    }

  
/** Enregistrement d'un mandant
*
* @author jean-philippe
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
**/ 
    public function store(Request $request){

        //   dd($request);

        if( $request['type_mandant'] == "personne_seule"){

            Mandant::create([
                "type" => $request['type_mandant'],
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
        elseif($request['type_mandant'] == "couple"){
            // dd($request);
            Mandant::create([
                "type" => $request['type_mandant'],
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
        elseif($request['type_mandant'] == "personne_morale"){
            
                    // dd($request);
                    $request->validate([
                
                        "forme_juridique_pm" => "string|required",
                        "raison_sociale_pm" => "string|required",
                        "document_justificatif" => "file:pdf,jpg,png|max:15000",
                    ]);
        
                    $mandant = new Mandant;
                    $newmandant =  $mandant->create([
                                    "type" => $request['type_mandant'],
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
                    $chemin = $this->saveDocument($request, $newmandant, "document_justificatif", "doc_justificatif"  );
                    $newmandant->document_justificatif = $chemin;
                    $newmandant->update();
        
                    $lastInsertId = $newmandant->id;
        
        
        
                                if(isset($request['contacts_associes_nom'])){
                                    // $mandant->mandants_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                                    $count = 0;
                                    foreach($request['contacts_associes_nom'] as $contact_id){
        
                                        $mandant->add_mandant($lastInsertId, $contact_id,$request['contacts_associes_titre'][$count]);
                                        $count ++;
                                    }
                                    
                                    
                                }
        
                                if(isset($request['type_mandant_send'])){
                                    // $mandant->mandants_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                                    $count1 = 0;
        
                                    for ($i = 0; $i < count($request['type_mandant_send']); $i++){                              
                                        //$mandant->add_mandant($lastInsertId, $contact,$request['contacts_associes_titre'][$count]);
        
                                        $newmandant =  Mandant::create([
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
        
                                        $mandant->add_mandant($lastInsertId, $newmandant->id,$request['contacts_associes_titre'][$i]);
        
                                    }
        
                                }
                            
                }

                elseif($request['type_mandant'] == "succession_personne"){
           
                    $newgroupe = Groupemandant::create([
                        "nom_groupe"=>$request['nom_groupe'],
                        "user_id" => auth()->id(),
                    ]);
        
                    if(isset($request['mandants_ajoute_id'])){
                        // $mandant->mandants_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                        $count = 0;
                        // $acque = Mandant::where('id',7)->firstorfail();
                        //  dd($acque);
                        foreach($request['mandants_ajoute_id'] as $mandant_id){
                            $mand = Mandant::where('id',$mandant_id)->firstorfail();
                            
                            $mand->add_groupemandant($mandant_id, $newgroupe->id);
                            $count ++;
                        }
                    }
        
                    if(isset($request['type_mandant_send'])){
                        // $mandant->mandants_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                        $count1 = 0;
        
                        for ($i = 0; $i < count($request['type_mandant_send']); $i++){                              
                            
                            $newmand =  Mandant::create([
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
        
                            $newmand->add_groupemandant($newmand->id, $newgroupe->id);
        
                        }
        
                    }
        
                }
                


        return back()->with('ok', __("Nouveau mandant ajouté"));
       

    }
    


/** Fonction de sauvegarde de document
*
* @author jean-philippe
* @param  \Illuminate\Http\Request  $request
* @param  App\Models\Mandant
* @param  String $file
* @param  String $fileType
* @return \Illuminate\Http\Response or int 
**/ 
    public function saveDocument( $request, Mandant $mandant, $file, $fileType  ){

        if($request->hasFile($file)){

            $file = $request->file($file);
            $extention ='.'.$file->getClientOriginalExtension();
            $filename =  time().'_'.$fileType.$extention;
            $folder = $mandant->id.'_'.$mandant->raison_sociale;
            
            
            
            $path =$file->storeAs(
                $folder, $filename, 'mandant'
            );
        return $folder."/".$filename;
        }

        return 0;
        
    }


/** Afficher le detail d'un mandant
*
* @author jean-philippe
* @param  App\Models\Mandant
* @return \Illuminate\Http\Response
**/ 
     public function show(Mandant $mandant){

        return view('mandants.detail', compact('mandant'));
    }

    //#########  Afficher le detail d'un groupe de mandants
    public function showGroupe(Groupemandant $groupe){

        return view('compenents.mandants.detailSuccession', compact('groupe'));
    }
    
    // ######## Modification d'un  mandant 
    public function update(Request $request,Mandant $mandant){
    
        
    
        if( $request['type_mandant'] == "personne_seule"){
                
            $mandant->type=$request['type_mandant'];
            $mandant->civilite=$request['civilite'];
            $mandant->nom=$request['nom'];
            $mandant->prenom=$request['prenom'];
            $mandant->categorie=$request['categorie'];
            $mandant->email=$request['email'];
            $mandant->source_contact=$request['source_contact'];
            $mandant->telephone_fixe=$request['telephone_fixe'];
            $mandant->telephone_mobile=$request['telephone_mobile'];
            $mandant->adresse=$request['adresse'];
            $mandant->code_postal=$request['code_postal'];
            $mandant->ville=$request['ville'];
            $mandant->pays=$request['pays'];
            $mandant->date_naissance= $request['date_naissance'];
            $mandant->lieu_naissance=$request['lieu_naissance'];
            $mandant->langue=$request['langue'];
            $mandant->note=$request['note'];

            $mandant->update();
            
            
        }
        elseif($request['type_mandant'] == "couple"){

            $mandant->type=$request['type_mandant'];
            $mandant->civilite=$request['civilite1'];
            $mandant->nom=$request['nom1'];
            $mandant->prenom=$request['prenom1'];
            $mandant->categorie=$request['categorie1'];
            $mandant->email=$request['email1'];
            $mandant->source_contact=$request['source_contact'];
            $mandant->telephone_fixe=$request['telephone_fixe1'];
            $mandant->telephone_mobile=$request['telephone_mobile1'];
            $mandant->adresse=$request['adresse1'];
            $mandant->code_postal=$request['code_postal1'];
            $mandant->ville=$request['ville1'];
            $mandant->pays=$request['pays1'];
            $mandant->date_naissance=$request['date_naissance1'];
            $mandant->lieu_naissance=$request['lieu_naissance1'];
            $mandant->langue=$request['langue1'];
            $mandant->note=$request['note1'];
            $mandant->civilite_partenaire=$request['civilite2'];
            $mandant->nom_partenaire=$request['nom2'];
            $mandant->prenom_partenaire=$request['prenom2'];
            $mandant->email_partenaire=$request['email2'];
            $mandant->telephone_fixe_partenaire=$request['telephone_fixe2'];
            $mandant->telephone_mobile_partenaire=$request['telephone_mobile2'];
            $mandant->adresse_partenaire=$request['adresse2'];
            $mandant->code_postal_partenaire=$request['code_postal2'];
            $mandant->ville_partenaire=$request['ville2'];
            $mandant->pays_partenaire=$request['pays2'];
            $mandant->date_naissance_partenaire=$request['date_naissance2'];
            $mandant->lieu_naissance_partenaire=$request['lieu_naissance2'];
            $mandant->langue_partenaire=$request['langue2'];
            $mandant->note_partenaire=$request['note2'];
            
            $mandant->update();

        }
        elseif($request['type_mandant'] == "personne_morale"){
            
            $request->validate([
                
                "forme_juridique_pm" => "string|required",
                "raison_sociale_pm" => "string|required",
                "document_justificatif" => "file:pdf,jpg,png|max:15000",
            ]);

            $mandant->type=$request['type_mandant'];
            $mandant->forme_juridique=$request['forme_juridique_pm'];
            $mandant->raison_sociale=$request['raison_sociale_pm'];
            $mandant->telephone_fixe=$request['telephone_fixe_pm'];
            $mandant->telephone_mobile=$request['telephone_mobile_pm'];
            $mandant->email=$request['email_pm'];
            $mandant->adresse=$request['adresse_pm'];
            $mandant->code_postal=$request['code_postal_pm'];
            $mandant->ville=$request['ville_pm'];
            $mandant->pays=$request['pays_pm'];
            $mandant->siret=$request['siret_pm'];
            $mandant->source_contact=$request['source_contact_pm'];
            $mandant->note=$request['note_pm'];
            
            $mandant->update();



           
                        // sauvegarde du document
            // $chemin = $this->saveDocument($request, $newmandant, "document_justificatif", "doc_justificatif"  );
            // $newmandant->document_justificatif = $chemin;
            // $newmandant->update();

             $lastInsertId = $mandant->id;



                        if(isset($request['contacts_associes_nom'])){
                            // $mandant->mandants_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                            $count = 0;
                            foreach($request['contacts_associes_nom'] as $contact_id){

                                $mandant->add_mandant($lastInsertId, $contact_id,$request['contacts_associes_titre'][$count]);
                                $count ++;
                            }
                            
                            
                        }

                        if(isset($request['type_mandant_send'])){
                            // $mandant->mandants_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
                            $count1 = 0;

                            for ($i = 0; $i < count($request['type_mandant_send']); $i++){                              
                                //$mandant->add_mandant($lastInsertId, $contact,$request['contacts_associes_titre'][$count]);

                                $newmand =  Mandant::create([
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

                                $mandant->add_mandant($lastInsertId, $newmand->id,$request['contacts_associes_titre'][$i]);

                            }

                        }
                    
        }

         return back()->with('ok', __("Ce mandant a été modifié"));
    }



/**  Modification d'un groupe de mandants
*
* @author jean-philippe
* @param  \Illuminate\Http\Request  $request
* @param  App\Models\Groupemandant
* @return \Illuminate\Http\Response
**/ 
    public function updateGroupe(Request $request,Groupemandant $groupe){           
    
        $groupe->nom_groupe = $request['nom_groupe'];
        $groupe->update();
       
        if(isset($request['mandants_ajoute_id'])){
           
            foreach($request['mandants_ajoute_id'] as $membre_id){

                $groupe->add_mandants($membre_id, $groupe->id);
               
            }
        }


        if(isset($request['type_mandant_send'])){
            // $mandant->mandants_associe()->attach($request['contact_associe'][0],["type_contact"=>$request['titre'] ]);
            $count1 = 0;

            for ($i = 0; $i < count($request['type_mandant_send']); $i++){                              
                //$mandant->add_mandant($lastInsertId, $contact,$request['contacts_associes_titre'][$count]);

                $newmand =  Mandant::create([
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

                $groupe->add_mandants($newmand->id, $groupe->id);
            }

        }
    
        

         return back()->with('ok', __("Ce groupe a été modifié"));
    }



/** Dissocier un mandant
*
* @author jean-philippe
* @param  App\Models\Mandant $mandant_morale
* @param  int $associe_id
* @return \Illuminate\Http\Response
**/ 
public function dissocier(Mandant $mandant_morale, $associe_id){

    $mandant_morale->detache_mandant($associe_id);
}


/** Supprimer un membre d'un groupe
* @author jean-philippe
* @param  App\Models\groupemandant $groupe
* @param  int $membre_id
* @return \Illuminate\Http\Response
**/ 
public function retirerMembre(Groupemandant $groupe, $membre_id){

    $groupe->detache_mandants($membre_id);
}


    
/** Suppression d'un mandant
*
* @author jean-philippe
* @param  App\Models\Mandant
**/ 
    public function delete(Mandant $mandant){

        $mandant->delete();
    }


/** Suppression d'un groupe de mandants
*
* @author jean-philippe
* @param  App\Models\groupemandant
**/ 
    public function deleteGroupe(Groupemandant $groupe){

        $groupe->delete();
    }


    // ####### affichage du formulaire de modifcation d'un mandant
    public function edit(Mandant $mandant){


        $mandants_moraux = Mandant::where('type','personne_morale')->get();
        $mandants_seuls = Mandant::where('type','personne_seule')->get();

        // Liste des id des mandants seuls deja associés à une personne morale
        $id_mandants_seuls_deja_assoc = array(); 

        // objet de type mandant, liste des mandants seuls non associé à une personne morale        
        $mandant_non_associe = array(); 
  

        // dans ce bloc on reccupere les id des mandants dejà associé à une personne morale
        foreach($mandants_moraux as $mandant_moral){

            foreach($mandant_moral->mandants_associe as $associe){
                 
                array_push($id_mandants_seuls_deja_assoc,$associe->pivot->mandant_assoc_id);
            }
        }

        // Dans ce bloc, on reccupere les mandants qui ne sont pas encore associé à une personne morale
        foreach($mandants_seuls as $mandant_seul){
            if( !in_array( $mandant_seul->id, $id_mandants_seuls_deja_assoc) ){
                 array_push($mandant_non_associe,  $mandant_seul ); 
            }
        }
      

      // on envoie à la vue le mandant à modifier et la liste des mandant non associé afin de pouvoir 
      // les associer aux mandants moraux

         $emails_mandant = Mandant::all()->pluck('email');

        return view('mandants.edit',compact('mandant','mandant_non_associe','emails_mandant'));
    }

     
/** affichage du formulaire de modifcation d'un groupe d'mandants
*
* @author jean-philippe
* @param  App\Models\goupemandant
* @return \Illuminate\Http\Response
**/ 
     public function editGroupe(Groupemandant $groupe){

        // les Id des membre du groupe
         $id_mandants_membres = array();

         // objet de type mandant, liste des mandants déjà associés à ce groupe      
         $mandant_non_membres = array(); 

         // Liste de tous les mandants
         $mandants = Mandant::All();
        
         foreach($groupe->mandants as $membre){
             array_push($id_mandants_membres, $membre->id) ;
         }

         foreach($mandants as $mandant){
            if(!in_array($mandant->id, $id_mandants_membres)){
                 array_push($mandant_non_membres, $mandant);
            }
         }           
   
       
 
       // on envoie à la vue l'mandant à modifier et la liste des mandant non associé afin de pouvoir 
       // les associer aux mandants moraux
 
          $emails_mandant = Mandant::all()->pluck('email');
          $noms_groupes = Groupemandant::all()->pluck('nom_groupe');
 
         return view('compenents.mandants.editGroupe',compact('groupe','mandant_non_membres','emails_mandant','noms_groupes'));
     }
}
