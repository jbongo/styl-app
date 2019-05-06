<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infospaliercommissions extends Model
{
    protected $fillable = [
        'nombre_palier','model_serialization',
    ];
    
    public function contrat()
    {
        return $this->belongsTo(Contrats::class);
    }
}
