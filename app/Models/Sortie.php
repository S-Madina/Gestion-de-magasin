<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sortie extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'utilisateur_id',
        'quantite',
        'date_sortie',
        'raison'
    ];

    // Relation - produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    // Relation - l'utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
