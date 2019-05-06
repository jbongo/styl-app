<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationCategories extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'nom', 'parent', 'tag', 'tag_color', 'soustag', 'soustag_color',
    ];
    public function formations()
    {
        return $this->hasMany(Formations::class);
    }
}