<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DossierVente extends Model
{
    protected $fillable = [
        'mandats_id','notaire_acq_id', 'notaire_mdn_id', 'factures_id','acquereurs_type', 'acquereurs_id', 'partenariat',
        'partenaire_id', 'notaire_compromis', 'notaire_acte','pourcentage_partenaire', 'compromis', 'vente', 'numero',
        'numero', 'status', 'rendez_vous_compromis', 'heure_compromis', 'adresse_compromis',
        'rendez_vous_acte', 'heure_acte', 'adresse_acte', 'dossier_compromis', 'dossier_acte',
        'dossier_bien', 'dossier_mandant', 'dossier_acquereur', 'serialize_doc_acquereur',
        'serialize_doc_mandant','serialize_doc_bien','pdf_facture_stylimmo','archive'
    ];

    public function mandat()
    {
        return $this->belongsTo(Mandats::class);
    }
}
