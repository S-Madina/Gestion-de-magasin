<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'utilisateur_id'
    ];

    // Relation-l'utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    // Relation - les entrées
    public function entrees()
    {
        return $this->hasMany(Entree::class);
    }

    // Relation - les sorties
    public function sorties()
    {
        return $this->hasMany(Sortie::class);
    }

    // Calcul du stock (diifférence entrées - sorties)
    public function getStockAttribute()
    {
        $totalEntrees = $this->entrees->sum('quantite');
        $totalSorties = $this->sorties->sum('quantite');
        return $totalEntrees - $totalSorties;
    }
}
