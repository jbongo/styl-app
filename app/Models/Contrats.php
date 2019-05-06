<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrats extends Model
{
    protected $fillable = [
        'user_id', 'demarrage_starter','id_starter', 'id_expert', 'id_abonnement_starter', 'id_abonnement_expert','id_parrainage',
        'numero_contrat','forfait_entree', 'forfait_remboursable', 'premiere_vente_pour_remboursement',
        'parrain', 'parrain_id','date_entree', 'date_debut_activitee','chemin_pdf_merge_contrat','chemin_pdf_infos', 
        'chemin_pdf_annex1', 'chemin_pdf_annex2', 'chemin_pdf_annex3', 'chemin_pdf_annex4','chemin_pdf_annex5', 'pourcentage_actuel',
        'chiffre_affaire_actuel', 'nbr_vente_actuel', 'nbr_filleuls_actuel','verif_rsac','archive',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function abonnement()
    {
        return $this->hasMany(Abonnement::class);
    }

    public function parrainage()
    {
        return $this->hasOne(Parrainage::class);
    }

    public function dircommission()
    {
        return $this->hasMany(Dircommission::class);
    }

    public function avenant()
    {
        return $this->hasMany(Avenants::class);
    }
}
