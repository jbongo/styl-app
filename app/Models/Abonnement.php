<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $fillable = [
        'user_id','pack_type', 'nom', 'tarif', 'nombre_annonces',
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
