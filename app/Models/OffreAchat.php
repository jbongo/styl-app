<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffreAchat extends Model
{
    protected $fillable = [
        'acquereur_type','biens_id', 'mandats_id','acquereur_id', 'status', 'acceptation',
        'montant_offre', 'montant_commission', 'charge_commission','date_ajout','date_fin',
        'conditions_suspensives','chemin_pdf'
    ];

    public function bien()
    {
        return $this->belongTo(Biens::class);
    }

    public function acquereur()
    {
        return $this->morphTo();
    }

    public function mandat()
    {
        return $this->belongTo(Mandats::class);
    }

    public function visite()
    {
        return $this->belongTo(Visites::class);
    }
}
