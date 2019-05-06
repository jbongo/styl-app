<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $fillable = [
        'type', 'user_id','civilite', 'nom', 'prenom', 'email', 'telephone', 'adresse', 'complement_adresse',
        'code_postal', 'ville', 'pays',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
