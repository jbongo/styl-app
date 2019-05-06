<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdresseFrance extends Model
{
    protected $fillable = [
        'departement','code_commune', 'nom_commune','code_postal',
        'longitude','latitude',
    ];
}
