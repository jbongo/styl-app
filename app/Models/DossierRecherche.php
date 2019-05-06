<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DossierRecherche extends Model
{
    protected $fillable = [
        'mandats_id','numero','archive'
    ];

    public function mandat()
    {
        return $this->belongsTo(Mandats::class);
    }
}
