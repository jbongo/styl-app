<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $fillable = [
        'canalprospection_id','nom', 'prenom', 'telephone','email', 
        'adresse', 'code_postal','ville','professionnel', 'pro_immo',
        'contact_etabli', 'type_immo', 'qualification',
    ];

    public function canalprospection()
    {
        return $this->belongsTo(Canalprospection::class);
    }

    public function suivirecrutements()
    {
        return $this->hasMany(Suivirecrutement::class);
    }
}
