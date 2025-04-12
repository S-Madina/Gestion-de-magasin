<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nom',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // relation avec produits
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    // relation avec les entrées
    public function entrees()
    {
        return $this->hasMany(Entree::class);
    }

    // relation avec les sorties
    public function sorties()
    {
        return $this->hasMany(Sortie::class);
    }
}
