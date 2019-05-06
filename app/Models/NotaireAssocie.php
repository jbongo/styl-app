<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaireAssocie extends Model
{
    protected $fillable = [
        'notaire_id', 'role','nom', 'email', 
        'telephone','archive',
    ];

    public function notaire()
    {
        return $this->belongsTo(Notaire::class);
    }
}
