<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infosentreprise extends Model
{
    protected $fillable = [
        'id','raison_siciale', 'nom_entreprise', 'adresse_siege_sociale', 'nom_prenom_gerant', 'capital',
        'siret', 'RCS', 'TVA', 'numero_carte_professionnelle', 'date_delivrance', 'organisme_delivrant',
        'nom_garant', 'adresse_garant',
    ];
    
    public function contrat()
    {
        return $this->belongsTo(Contrats::class);
    }
}
