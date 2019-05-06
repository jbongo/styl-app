<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupemandant extends Model
{
    protected $guarded = [];

    public function mandants(){
        return $this->belongsToMany('App\Models\Mandant','mandant_groupemandant','groupe_mandant_id','mandant_id');
    }
    

    public function add_mandants($mandant_id,$groupe_mandant_id){
        $this->mandants()->attach($mandant_id,["groupe_mandant_id"=>$groupe_mandant_id]);    
    }


    public function detache_mandants($mandant_id){

        $this->mandants()->detach($mandant_id);    
    }
}
