<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formations extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'titre', 'type',
    ];
    public function category()
    {
        return $this->belongsTo(FormationCategories::class);
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User','user_formation', 'formations_id','user_id')->withTimestamps();
    }
}
