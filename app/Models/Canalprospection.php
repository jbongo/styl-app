<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canalprospection extends Model
{
    protected $fillable = [
        'nom_canal', 'type', 'site_web',
    ];

    public function leads()
    {
        return $this->hasMany(Leads::class);
    }
}
