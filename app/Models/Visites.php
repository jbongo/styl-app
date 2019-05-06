<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visites extends Model
{
    protected $fillable = [
        'biens_id', 'appels_id', 'nom_visiteur', 'adresse', 'code_postal',
        'ville','date_visite', 'commentaires',
    ];

    public function biens()
    {
        return $this->belongsTo(Biens::class);
    }

    public function appels()
    {
        return $this->belongsTo(Appels::class);
    }

    public function offre_achat()
    {
        return $this->hasOne(OffreAchat::class);
    }
}
