<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dircommission extends Model
{
    protected $fillable = [
        'user_id','pack_type', 'nom', 'pourcentage_depart', 'palier', 'serialize_palier',
        'duration_starter','duration_gratuitee', 'minimum_vente', 'minimum_fileuls', 'minimum_chiffre_affaire',
        'sub_pourcentage',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contrat()
    {
        return $this->belongsTo(Contrats::class);
    }
}
