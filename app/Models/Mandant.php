<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mandant extends Model
{
    protected $guarded = [];
    
    public function mandants_associe(){

        return $this->belongsToMany('App\Models\Mandant','mandant_mandant','mandant_id','mandant_assoc_id')->withPivot('titre_contact');
    }

    public function add_mandant($mandant_id,$mandant_assoc_id, $titre_contact){

        $this->mandants_associe()->attach($mandant_assoc_id,["mandant_id"=>$mandant_id, "titre_contact"=>$titre_contact]);    
    }


    public function detache_mandant($associe_id){

        $this->mandants_associe()->detach($associe_id);    
    }


    public function groupemandants(){
        return $this->belongsToMany('App\Models\Groupemandant','mandant_groupemandant','mandant_id','groupe_mandant_id');
    }
    

    public function add_groupemandant($mandant_id,$groupe_mandant_id){
        $this->groupemandants()->attach($groupe_mandant_id,["mandant_id"=>$mandant_id]);    
    }


    public function detache_groupemandant($groupe_mandant_id){

        $this->groupemandants()->detach($groupe_mandant_id);    
    }
}
