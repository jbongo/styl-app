<?php

namespace App\Http\Controllers\Users;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\infosComplementaireRequest;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\Mail;
use App\Mail\completeAccount; 
use App\Mail\UserAccountCreate;
use Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Notification;
use App\Notifications\UserCompleteInfo ;
use App\Models\Mandant;
use App\Models\Acquereur;


class UsersController extends Controller
{
    /**
     * Affiche la liste des utilisateurs non archivés
     * @author jean-philippe
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where([['archive',0], ['role', '!=', 'guest'],])->get();
        return view('users.index',compact('users'));    
    }


    /**
     * Création d'un utilisateur
     *
     * @param  App\Http\Requests\UserAddRequest  $data
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $data)
    {
         $pwd = str_random(8);
         $security = Crypt::encrypt($pwd);
         $newuser = User::create([ 
             'nom' => $data['val-lastname'],
             'prenom' => $data['val-firstname'],
             'civilite' => $data['val-civilite'],
             'email' => $data['email'],
             'password' => bcrypt($pwd),
             'password_temporaire' => $security,
             'adresse' => $data['val-adress'],
             'complement_adresse' => ($data['val-compl_adress'] != null) ? $data['val-compl_adress'] : "Non renseigné" ,
             'code_postal' => $data['val-zip'],
             'ville' => $data['val-town'],
             'pays' => $data['val-country'],
             'telephone' => $data['val-phone'],
             'role' => $data['val-select']
         ]);
         // un mail est envoyé au nouvel utlisateur pour lui envoyer ses accès
         $this->sendmailProfil($newuser->id);
         
         return redirect()->route('users')->with('ok', __('L\'utilsateur '.$data['val-lastname'].'  a bien été enregistré. Ses accès lui seront envoyé par mail'));
    
    }

    /**
     * Affiche un utilisateur
     *
     * @author jean-philippe
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = $user::find($user->id);
        return view ('users.detail',compact('user'));
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur
     *
     * @author jean-philippe
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = user::find($user->id);
        return view('users.edit',compact('user'));
    }

    /**
     * Met à jour les informations d'un utilisateur.
     *
     * @author jean-philippe
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($request->input('val-select'));
        $user->nom = $request->input('val-lastname');
        $user->prenom = $request->input('val-firstname');
        $user->email = $request->input('email');
         $user->role = $request->input('val-select');
        $user->civilite = $request->input('val-civilite');
        $user->adresse = $request->input('val-adress');
        $user->complement_adresse = $request->input('val-compl_adress');
        $user->code_postal = $request->input('val-zip');
        $user->ville = $request->input('val-town');
        $user->pays = $request->input('val-country');
        $user->telephone = $request->input('val-phone');

        $user->update();

        return redirect()->route('users')->with('ok', __('L\'utilsateur   a bien été Modifié'));
    }

    /**
     * Supprime un utilisateur.
     *
     * @author jean-philippe
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
 
         $user->delete();
        return response()->json();
        //  return redirect()->route('users')->with('ok', __('L\'utilsateur   a bien été supprimé'));
    }

    /**
     * Archive ou restaure un utilisateur.
     *
     * @author jean-philippe
     * @param  App\Models\User $user
     * @param  int $arch
     * @return \Illuminate\Http\Response
     */
    public function archive(User $user,$arch)
    {

       $user->archive = $arch;
       $user->update();
       return response()->json();
        //  return redirect()->route('users')->with('ok', __('L\'utilsateur   a bien été supprimé'));
    }

    /**
     * Retourne la liste des utilisateurs archivés 
     * 
     * @author jean-philippe 
     * @return \Illuminate\Http\Response
     */
    public function archiveListe()
    {
        $users = User::where('archive',1)->get();
        
        return view('users.archive',compact('users'));
    }



/**
 * Fonction qui retourne la vue permettant de modifier les rôles des utilisateurs
 * 
 * @author jean-philippe
 * @return \Illuminate\Http\Response
*/
    public function parametres(){
        $users = User::where('archive',0)->get();

        return view('users.parametres',compact('users'));
    }


/** 
 * afficher les infos d'un utlisateur dans une fenetre modal afin de modifier son role 
 * 
 * @author jean-philippe
 * @param  App\Models\User $user
 * @param  Int $id
 * @return \Illuminate\Http\Response
*/
    public function getRoleUpdate(User $user, $id){
        $user = $user->where('id',$id)->get();
        
        return json_encode($user);
    }

/** 
 * Modifier le role d'un utilisateur
 * 
 * @author jean-philippe
 * @param  \Illuminate\Http\Request  $request
 * @param  App\Models\User $user
 * @return \Illuminate\Http\Response
*/
    public function setRoleUpdate(Request $request, User $user){
         $user->role = $request->input('role');
         $user->update();

        return $request->input('role');
    }


/** 
 * Obtenir la page de profile d'un utlisateur
 * 
 * @author jean-philippe
 * @return \Illuminate\Http\Response
**/ 
    public function profile(){
        $user = User::where('id',Auth()->id())->first();

        return view ('users.profile',compact('user'));
    }

/** 
 * Modifier la photo de profile
 * 
 * @author jean-philippe
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
*/
    public function photoProfile(Request $request){

        $request->validate([
            "photo" => "required|image|max:5000",
        ]);

        $user = User::where('id',Auth()->id())->first();
       
        if($request->hasFile('photo')){
            $avatar = $request->file('photo');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $filename = $user->id.'_'.$user->nom.'_'.$filename;
            Image::make($avatar)->save( public_path('\images\photo_profile\\' . $filename ) );
            
            
            // on supprime l'ancienne photo si elle existe
            if($user->photo_profile) {
                
                $img = public_path('images/photo_profile/'.$user->photo_profile);
              
                if(File::exists($img) ){
                   File::delete($img);
               }
               
            }

            $user->photo_profile = $filename;
            $user->update();
        }

        return back()->with('ok', __("La photo a bien été enregistrée"));
    }


/**  
 * afficher formulaire des infos complementaires
 * 
 * @author jean-philippe
 * @return \Illuminate\Http\Response
**/
    public function infosComplementaires(){
        $user = User::where('id',auth()->id())->firstorfail();
        
        return view ('users.addInfosComplementaire',compact('user'));
    }

/** 
 * ajouter les infos complementaires
 * 
 * @author jean-philippe
 * @param  \App\Http\Request\infosComplementaireRequest  $request
 * @param  App\Models\User
 * @return \Illuminate\Http\Response
*/
    public function addInfosComplementaires(infosComplementaireRequest $request, User $user ){
    
       $user->situation_matrimoniale = $request->situation_matri;
       $user->nom_jeune_fille = $request->nom_jeune_fille;
       $user->date_naissance = $request->date_naissance;
       $user->ville_naissance = $request->ville_naissance;
       $user->pays_naissance = $request->pays_naissance;
       $user->nationnalite = $request->nationalite;
       $user->nom_prenom_pere = $request->nom_pere;
       $user->nom_prenom_mere = $request->nom_mere;
       $user->comment_connu_styli = $request->comment_connu_styli;
       $user->ou_souhaiter_exercer = $request->ou_exercer;
       $user->description = $request->description;
       $user->autres_infos = $request->autre_info;
       $user->statut_juridique = $request->statut_juridique;
       $user->numero_siret = $request->numero_siret;
       $user->numero_siren = $request->numero_siren;
       $user->code_caf = $request->code_naf;
       $user->date_immatriculation = $request->date_immatriculation;
       $user->numero_tva = $request->numero_tva;
       $user->numero_rcs = $request->numero_rcs;
       $user->nom_legal_entreprise = $request->nom_legal;
       $user->linkedin = $request->linkedin;
       $user->facebook = $request->facebook;
       $user->twitter = $request->twitter;
       $user->instagram = $request->instagram;
       $user->nom_banque = $request->nom_banque;
       $user->numero_compte = $request->numero_compte;
       $user->iban = $request->iban;
       $user->bic = $request->bic;
    //    $user->numero_carte_pro = $request->numero_carte;
    //    $user->nom_organisme_delivrant_carte_pro = $request->nom_organisme_deliv;
    //    $user->date_delivrance_carte_pro = $request->date_delivrance;
    //    $user->numero_assurance = $request->numero_assurance;
    //    $user->nom_organisme_assurance = $request->nom_organisme_assurance;
       $user->type_piece_identite = $request->type_piece_identite;
       $user->profile_complete = 1;
      
       // Sauvegarde des documents
       $path_piece_identite = $this->saveDocument($request, $user, 'piece_identite','piece_identite');
       $path_livret_famille = $this->saveDocument($request, $user, 'livret_famille','livret_de_famille');
       $path_rib_banque = $this->saveDocument($request, $user, 'rib_banque','rib');
       $path_registre_commerce = $this->saveDocument($request, $user, 'registre_commerce','registre_de_commerce');
       $path_carte_pro = $this->saveDocument($request, $user, 'carte_pro','carte_professionnelle');
       $path_attestation_assurance = $this->saveDocument($request, $user, 'attestation_assurance','attestation_assurance_ou_responsabilite');
       
    //    dd(isset($request->piece_identite));
       
       $user->piece_identite =  (isset($request->piece_identite) ) ? $path_piece_identite : $user->piece_identite  ;
       $user->livret_famille = (isset($request->livret_famille) ) ? $path_livret_famille : $user->livret_famille  ;
       $user->rib_banque = (isset($request->rib_banque) ) ? $path_rib_banque : $user->rib_banque  ;
       $user->registre_commerce_ou_attestation_immatriculation = (isset($request->registre_commerce) ) ? $path_registre_commerce : $user->registre_commerce_ou_attestation_immatriculation  ;
       $user->carte_pro = (isset($request->carte_pro) ) ? $path_carte_pro : $user->carte_pro  ;
       $user->attestation_assurance_responsabilite_civile = (isset($request->attestation_assurance) ) ? $path_attestation_assurance : $user->attestation_assurance_responsabilite_civile  ;
              
       

    //    if($user->role == "prospect_plus" || $user->role == "prospect"){
    //        if(isset($request->carte_pro) && isset($request->attestation_assurance)  ){
    //             $user->role = "mandataire";
    //         }
    //         else{
    //             if(!isset($user->carte_pro) || !isset($user->attestation_assurance_responsabilite_civile)){
    //                 $user->role = "prospect_plus";
    //             }
    //             if(isset($user->carte_pro) && isset($user->attestation_assurance_responsabilite_civile))
    //             {
    //                 $user->role = "mandataire";
    //             }
    //         }
    //    }
       
       
     
       $val = $user->update();

       $auser = User::where('role','admin')->get();

       Notification::send($auser, new UserCompleteInfo($user));
      

       return back()->with('ok', __("Vos informations ont été modifiées"));
    //   return $val.'';

    }

    public function saveDocument( $request, User $user, $file, $fileType  ){

        if($request->hasFile($file)){

            $file = $request->file($file);
            $extention ='.'.$file->getClientOriginalExtension();
            $filename =  time().'_'.$fileType.$extention;
            $folder = $user->id.'_'.$user->nom;
            
            
            $path =$file->storeAs(
                $folder, $filename, 'documents'
            );
        return $path;
        }

        return 0;
        
    }

/** 
 * Envoi d'un mail à l'utlisateur crée
 * 
 * @author jean-philippe
 * @param  int $id
 * @return \Illuminate\Http\Response
*/
    public function sendmailProfil($id){
        $user = User::find($id);

        if($user->role == "admin" || $user->role == "personnel" ){
             $sendMail = new UserAccountCreate($user);
        }
        else{
            $sendMail = new completeAccount($user);
        }
       
        Mail::to($user)->send($sendMail)  ;
        return back()->with('ok', __('Un email a été envoyé à l\'utilisateur'));
      
    }

/** 
 * Téléchargement des documents de l'utilisateur
 * 
 * @author jean-philippe
 * @param  App\Models\User $user
 * @param  String $type_document
 * @return \Illuminate\Http\Response
**/
    public function getDocument(User $user, String $type_document){

        $doc = "";
        if($type_document == "piece_identite"){
            $doc = $user->piece_identite;
        }elseif($type_document == "livret_famille"){
            $doc = $user->livret_famille;
        }elseif($type_document == "rib"){
            $doc = $user->rib_banque;
        }elseif($type_document == "registre_commerce"){
            $doc = $user->registre_commerce_ou_attestation_immatriculation;
        }elseif($type_document == "carte_pro"){
            $doc = $user->carte_pro;
        }elseif($type_document == "attestation_assurance"){
            $doc = $user->attestation_assurance_responsabilite_civile;
        }

        $path = public_path('documents\\'.$doc) ;
        return response()->download($path);
    }

    /*generer l'avenant*/
    public function avenant_edit($id)
    {
        $user = User::find($id);
        return view('contrats.edituser', compact('user'));
    }

    public function avenant_update(Request $request, $id)
    {
        $update = User::find($id);
        $update->situation_matrimoniale = $request['choice-marital'];
        $update->nom_jeune_fille = $request['val-fille'];
        $update->adresse = $request['val-adress'];
        $update->complement_adresse = $request['val-compl_adress'];
        $update->ville = $request['val-ville'];
        $update->code_postal = $request['val-zip'];
        $update->nationnalite = $request['nationality-country'];
        $update->statut_juridique = $request['choice-corporate'];
        $update->numero_siret = $request['siret'];
        $update->numero_siren = $request['siren'];
        $update->code_caf = $request['naf'];
        $update->date_immatriculation = $request['date-matricle'];
        $update->numero_tva = $request['tva'];
        $update->numero_rcs = $request['rcs'];
        $update->nom_legal_entreprise = $request['nom-legal'];
        $update->numero_carte_pro = $request['val-rsac'];
        $update->nom_organisme_delivrant_carte_pro = $request['val-gref'];
        $update->date_delivrance_carte_pro = $request['val-date'];
        $update->nom_organisme_assurance = $request['val-care'];
        $update->numero_assurance = $request['val-num'];
        $update->update();
        return redirect()->route('contrat.index')->with('ok', __('Les information ont étaient modifiées.'));
    }
}
