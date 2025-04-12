<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entree extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'utilisateur_id',
        'quantite',
        'date_entree',
        'commentaire'
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
