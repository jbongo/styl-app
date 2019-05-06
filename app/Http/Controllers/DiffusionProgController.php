<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passerelles;
use App\Models\Biens;
use App\Models\User;
use App\Models\BienPasserelle;
use App\Models\Diffusion;
use App\Models\Annonce;


class DiffusionProgController extends Controller
{
 

/** 
 * Renvoie la page de plannification de diffusions
 *
 * @author jean-philippe
 * @param App\Models\Biens $bien
 * @return \Illuminate\Http\Response
*/ 
    public function create(Biens $bien_id){
       
        
        $passerelles = Passerelles::where('type',"Avec abonnement")->get();
        
       
        $passerelles_size = sizeof($passerelles);
        $passerelles = $passerelles->toJson() ;
        $annonces = Annonce::where('bien_id',$bien_id->id)->get();
        $bien = $bien_id;
       
        return view('diffusion.prog.add_diffusion',compact(['passerelles','bien','passerelles_size','annonces']));
    }

/** 
 * Liste des passerelles 
 *
 * @author jean-philippe
 * @return \Illuminate\Http\Response
*/ 
    public function index_prog(){
        $passerelles = Passerelles::all();
        
        // les admins ont accès à tous les biens
        if(Auth()->user()->role== "admin"){
            $biens = Biens::all();
        }
        else{
            $biens = Biens::where('user_id',auth()->id())->get();            
        }
        
        return view('diffusion.diffusion_prog',compact(['passerelles','biens']));
    }


/** Affiche la page sur laquelle on choisit les date de diffusion et les annonces 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function date_annonce( $passerelles, $bien_id){
        
        // return json_decode($passerelles, true);
        $passerelles_id = array();
        foreach( json_decode($passerelles, true) as $id){          
            array_push($passerelles_id, (int)$id );
        }
        
        $passerelles_id = json_encode($passerelles_id);



        $passerelles = Passerelles::whereIn('id',json_decode($passerelles, true))->get();
        $bien = Biens::where('id',$bien_id)->firstOrFail();
    //  dd($passerelles_id);

        return view('diffusion.prog.date_annonce',compact(['passerelles','bien','passerelles_id']));
    }

/** Programmer la diffusion
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function diffuser_prog(Request $request ){
        
        $ranges =  json_decode($request->ranges, true);
        $passerelles =  json_decode($request->passerelles,true);
        $passerelles_id = json_encode($request->passerelles_id) ;
        
      
        
        foreach($ranges as $range){
            //  return $range["date_begin"];
            $date_begin = date("Y-m-d H:i:s", $range["date_begin"]);
            $date_end = date("Y-m-d H:i:s", $range["date_end"]);

            Diffusion::create([
            "biens_id"=>$request->bien_id,
            "annonce_id"=>$range["appear"],
            "passerelles"=>$passerelles_id,
            "date_debut"=>$date_begin,
            "date_fin"=>$date_end,
           ]); 
        }
        
        
        return $request->ranges;
    
    }

/** Liste des diffusions pour un bien 
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function listeDiffusion($type, $bien_id){
       
        if($type =="next"){
            $diffusions = Diffusion::where([ ['biens_id',$bien_id],['date_debut','>',now()] ])->get();
        }elseif($type=="now"){

            $diffusions = Diffusion::where([ ['biens_id',$bien_id],['date_debut','<=',now()],['date_fin','>=', now()] ])->get();
        }else{
            $diffusions = Diffusion::where('biens_id',$bien_id)->get();
        }
        $bien = Biens::where('id',$bien_id)->firstOrFail();
        
        $nb_next = Diffusion::where([ ['biens_id',$bien_id],['date_debut','>',now()] ])->count();
        $nb_now =  Diffusion::where([ ['biens_id',$bien_id],['date_debut','<=',now()],['date_fin','>=', now()] ])->count();
        $nb_all = Diffusion::where('biens_id',$bien_id)->count();
        return view('diffusion.prog.liste_diffusion',compact(['diffusions','bien','type','nb_next','nb_now','nb_all']));
    }

/** Supprimer une diffusion
*
* @author jean-philippe
* @return \Illuminate\Http\Response
**/ 
    public function delete(Diffusion $diffusion){

     $result =   $diffusion->delete();
    } 

}
