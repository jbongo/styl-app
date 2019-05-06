<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passerelles extends Model
{
    protected $guarded = []; // contraire de fillable, on accepte tous les champs

    public function biens() 
    {
        return $this->belongsToMany('App\Models\Biens','bien_passerelles','passerelle_id','bien_id');
    }
}
