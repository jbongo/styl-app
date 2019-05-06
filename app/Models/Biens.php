<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biens extends Model
{
    //
    protected $guarded = [];

    public function photosbiens(){

        return $this->hasMany('App\Models\Photosbien');
    }

    public function mandat_ok()
    {
        return $this->hasOne(Mandats::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function passerelles()
    {
        return $this->belongsToMany('App\Models\Passerelles','bien_passerelles','bien_id','passerelle_id');
    }
    public function visites()
    {
        return $this->hasMany(Visites::class);
    }

    public function offreachat()
    {
        return $this->hasMany(OffreAchat::class);
    }

    public function appels()
    {
        return $this->hasMany(Appels::class);
    }
    
    public function annonces(){
        return $this->hasMany('App\Models\Annonce','bien_id');
    }

    public function diffusion(){
        return $this->hasMany(Diffusion::class,'bien_id');
    }
}
