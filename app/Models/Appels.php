<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appels extends Model
{
    protected $fillable = [
        'biens_id','source', 'passerelles_id', 'nom_appelant',
        'code_postal', 'date', 'commentaires'
    ];

    public function biens()
    {
        return $this->belongsTo(Biens::class);
    }

    public function visites()
    {
        return $this->hasOne(Visites::class);
    }
}
