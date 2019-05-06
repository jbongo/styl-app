<?php

namespace App\Http\Controllers;
use App\Models\Passerelles;
use App\Models\Biens;
use App\Models\BienPasserelle;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PasserelleController extends Controller
{

    private $logo_path;

    public function __construct(){
        $this->logo_path = public_path('/images/passerelles');
    }

    
/** Liste des passerelles 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function index(){
        $passerelles = Passerelles::all();
        // dd($passerelles);
        return view('passerelle.index',compact('passerelles'));
    }


/** Formulaire d'ajout d'une passerelle 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/    
    public function create(){
        return view('passerelle.add');
    }


/** Ajout d'une passerelle 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/    
    public function store(Request $request){
        // dd($this->logo_path);
        $request->validate([
            'type_passerelle'=>'required|string',
            'nom'=>'required|string|unique:passerelles',
            'reference'=>'required|string|unique:passerelles',
            'site' => 'required|url|unique:passerelles',
            'logo' => 'required|image:jpg,png|max:5000',
            
        ]);
        
        $logo = $request->file('logo');

        // dd($logo);
        
        if (!is_dir($this->logo_path)) {
            mkdir($this->logo_path, 0777);
        }

        

        $logo_name = sha1(date('YmdHis') .str_random(30));
        $resize_logo_name = $logo_name. str_random(2). '.' .$logo->getClientOriginalExtension();
        
        Image::make($logo)
            ->resize(550, 350)
            ->save($this->logo_path .'/'.$resize_logo_name);
        
        $logo->move($this->logo_path, $resize_logo_name);

        Passerelles::create([
            "type"=>$request->type_passerelle,
            "nom"=>$request->nom,
            "reference"=>$request->reference,
            "site"=>$request->site,
            "logo"=>$resize_logo_name,
            "contact"=>$request->contact,
            "statut"=>1,
            "texte_fin_annonce"=>$request->text_ajouter,
        ]);
        
        return back()->with('ok',__("Nouvelle passerelle ajoutée"));
    }

/** Obtenir une passerelle avec son id 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function getPasserelle(Passerelles $id){
        $passerelle =$id;
        // dd($passerelles);
        return json_encode($passerelle) ;
    }

/** supprimer une passerelle avec son id 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function edit(Passerelles $passerelle, Request $request){

        // dd($passerelle);
        return view('passerelle.edit',compact('passerelle'));
    }

/** Modifier une passerelle 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/    
public function update(Passerelles $passerelle, Request $request){

    if($passerelle->nom == $request->nom && $passerelle->site == $request->site ){
        $request->validate([
            'type_passerelle'=>'required|string',
            'nom'=>'required|string',
            'site' => 'required|url',
            'logo' => 'image:jpg,png|max:5000',        
        ]);
    }elseif($passerelle->nom == $request->nom && $passerelle->site != $request->site){
        $request->validate([
            'type_passerelle'=>'required|string',
            'nom'=>'required|string',
            'site' => 'required|url|unique:passerelles',
            'logo' => 'image:jpg,png|max:5000',        
        ]);
    }elseif($passerelle->nom != $request->nom && $passerelle->site == $request->site){
        $request->validate([
            'type_passerelle'=>'required|string',
            'nom'=>'required|string|unique:passerelles',
            'site' => 'required|url',
            'logo' => 'image:jpg,png|max:5000',        
        ]);
    }
    else{
        $request->validate([
            'type_passerelle'=>'required|string',
            'nom'=>'required|string|unique:passerelles',
            'site' => 'required|url|unique:passerelles',
            'logo' => 'image:jpg,png|max:5000',        
        ]);
    }
    
    
    if($request->file('logo') )
    {

        $logo = $request->file('logo');
        // dd($logo);
    
        if (!is_dir($this->logo_path)) {
            mkdir($this->logo_path, 0777);
        }

        $logo_name = sha1(date('YmdHis') .str_random(30));
        $resize_logo_name = $logo_name. str_random(2). '.' .$logo->getClientOriginalExtension();
        
        // suppression de l'ancienne image
        @unlink($this->logo_path."/".$passerelle->logo);

        Image::make($logo)
            ->resize(550, 350)
            ->save($this->logo_path .'/'.$resize_logo_name);        
            $logo->move($this->logo_path, $resize_logo_name);
        
            $passerelle->logo = $resize_logo_name;

    }
   
    $passerelle->type = $request->type_passerelle;
    $passerelle->nom = $request->nom;
    $passerelle->site = $request->site;
    $passerelle->contact = $request->contact;
    $passerelle->texte_fin_annonce = $request->text_ajouter;

    $passerelle->update();

    return back()->with('ok',__("Passerelle modifiée"));
}


/** formulaire d'édition d'une passerelle
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function delete(Passerelles $passerelle){
        $passerelle->delete();
        return back()->with('ok',__("passerelle supprimée"));
    }

/** Activer ou désactiver une passerelle
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function statut(Passerelles $passerelle, $statut){
        
        $passerelle->statut  = $statut;
        $passerelle->update();

        return back()->with('ok',__("Statut modifié"));
    }

/** Ascocier une passerelle au bien
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
public function attach_passerelle_bien( Request $request, $bien_id){
    
   $data = json_decode($request["pass_bien"], true);

   $bienpass = BienPasserelle::all();
   $bienpass = $bienpass->toArray();
  
   for($i = 0; $i < sizeof($data) ;$i++){
        // si la passerelle est cochée pour le bien
        if($data[$i][1] == true){
            // si le bien n'est pas encore associé à la passerelle on l'y associe'
            if(BienPasserelle::where([ ["bien_id",$bien_id], ["passerelle_id",$data[$i][0]]])->count() == 0){
               
                BienPasserelle::create([
                "bien_id"=> $bien_id,
                "passerelle_id"=> $data[$i][0],
                ]);
            }
            
        }elseif($data[$i][1] == false){
            // si le bien estdéjà associé à la passerelle on supprime l'association
            if(BienPasserelle::where([ ["bien_id",$bien_id], ["passerelle_id",$data[$i][0]]])->count() == 1){
                
                BienPasserelle::where([ ["bien_id",$bien_id], ["passerelle_id",$data[$i][0]]])->delete();
                
            }
        }
   }

    return back()->with('ok',__("Statut modifié"));
}
    
}
