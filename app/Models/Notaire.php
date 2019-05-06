<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notaire extends Model
{
    protected $fillable = [
        'role','nom', 'email', 
        'telephone', 'code_postal','ville','adresse','archive',
    ];

    public function notaire_associe()
    {
        return $this->hasMany(NotaireAssocie::class);
    }
}
