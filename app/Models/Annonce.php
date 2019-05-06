<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    //
    protected $fillable = [
        'identifiant_annonce','titre', 'description','prix', 'bien_id'
    ];

    public function photosannonce(){

        return $this->hasMany('App\Models\Photosbien');
    }
}
