<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facturation extends Model
{
    protected $fillable = [
        'user_id', 'role', 'nom', 'adresse', 'zip', 'paiement', 'mode', 'date_paiement', 'ville',
        'email', 'montant_ht', 'montant_ttc', 'chemin_pdf','archive',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function factureproduct()
    {
        return $this->hasMany(Factureproduct::class);
    }
}
