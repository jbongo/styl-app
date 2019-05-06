<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupeacquereur extends Model
{
    protected $guarded = [];

    public function acquereurs(){
        return $this->belongsToMany('App\Models\Acquereur','acquereur_groupeacquereur','groupe_acquereur_id','acquereur_id');
    }
    

    public function add_acquereurs($acquereur_id,$groupe_acquereur_id){
        $this->acquereurs()->attach($acquereur_id,["groupe_acquereur_id"=>$groupe_acquereur_id]);    
    }


    public function detache_acquereurs($acquereur_id){

        $this->acquereurs()->detach($acquereur_id);    
    }

    public function offreachat()
    {
        return $this->morphMany(OffreAchat::class, 'acquereur');
    }
}
