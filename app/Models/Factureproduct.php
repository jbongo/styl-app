<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factureproduct extends Model
{
    protected $fillable = [
        'facture_id', 'quantite', 'description', 'prix_unitaire_ht',
    ];

    public function facture()
    {
        return $this->belongsTo(Facturation::class);
    }
}
