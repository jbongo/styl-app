<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diffusion extends Model
{
    //
    protected $guarded = [];

    public function annonce(){
        return $this->belongsTo('App\Models\Annonce');
    }
}
