<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['nom','prenom'];
    protected $guarded = []; // contraire de fillable, on accepte tous les champs
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function abonnement()
    {
        return $this->hasMany(Abonnement::class);
    }

    public function parrainage()
    {
        return $this->hasOne(Parrainage::class);
    }

    public function dircommission()
    {
        return $this->hasMany(Dircommission::class);
    }

    public function partners()
    {
        return $this->hasMany(Partners::class);
    }

    public function contrats()
    {
        return $this->hasOne(Contrats::class);
    }

    public function biens(){
        return $this->hasMany(Biens::class);
    }

    public function formations(){
        return $this->belongsToMany('App\Models\Formations','user_formation', 'user_id','formations_id')->withTimestamps();
    }
}
