<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParamsAffaire extends Model
{
    protected $fillable = [
        'list_documents', 'pourcentage_partenaire', 'max_offre', 'notif_mandant', 
        'notif_acquereur', 'archive_bien', 'archive_mandant', 'archive_acquereur', 
        'max_jour_notaire',
    ];
}
