<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mandats extends Model
{
    protected $fillable = [
        'objet', 'role_mandant','users_id','biens_id', 'mandant_id',
        'numero', 'type','statut', 'date_debut', 'date_fin', 'annulation',
        'raison_annulation', 'note', 'note_annulation','archive',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dossiervente()
    {
        return $this->hasOne(DossierVente::class);
    }
    
    public function dossierrecherche()
    {
        return $this->hasOne(DossierRecherche::class);
    }

    public function bien()
    {
        return $this->belongsTo(Biens::class);
    }

    public function offreachat()
    {
        return $this->hasMany(OffreAchat::class);
    }
}
