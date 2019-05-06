<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avenants extends Model
{
    protected $fillable = [
        'contrat_id','type', 'signature','chemin_pdf', 
    ];

    public function contrat()
    {
        return $this->belongsTo(Contrats::class);
    }
}
