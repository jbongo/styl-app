<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suivirecrutement extends Model
{
    protected $fillable = [
        'leads_id', 'role', 'confirmation', 'date', 'heure',
        'commentaires',
    ];

    public function leads()
    {
        return $this->belongsTo(Leads::class);
    }
}
