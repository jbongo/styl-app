<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acquereur extends Model
{
    protected $guarded = [];

    public function acquereurs_associe(){

        return $this->belongsToMany('App\Models\Acquereur','acquereur_acquereur','acquereur_id','acquereur_assoc_id')->withPivot('titre_contact');
    }

    public function add_acquereur($acquereur_id,$acquereur_assoc_id, $titre_contact){

        $this->acquereurs_associe()->attach($acquereur_assoc_id,["acquereur_id"=>$acquereur_id, "titre_contact"=>$titre_contact]);    
    }


    public function detache_acquereur($associe_id){

        $this->acquereurs_associe()->detach($associe_id);    
    }



    public function groupeacquereurs(){
        return $this->belongsToMany('App\Models\Groupeacquereur','acquereur_groupeacquereur','acquereur_id','groupe_acquereur_id');
    }
    

    public function add_groupeacquereur($acquereur_id,$groupe_acquereur_id){
        $this->groupeacquereurs()->attach($groupe_acquereur_id,["acquereur_id"=>$acquereur_id]);    
    }


    public function detache_groupeacquereur($groupe_acquereur_id){

        $this->groupeacquereurs()->detach($groupe_acquereur_id);    
    }

    public function offreachat()
    {
        return $this->morphMany(OffreAchat::class, 'acquereur');
    }
}
