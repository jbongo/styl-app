<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parrainage extends Model
{
    protected $fillable = [
        'user_id','nom', 'forfait_100percent', 'pourcentage_annee1','nombre_annee', 'serialize_annee_data'
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
