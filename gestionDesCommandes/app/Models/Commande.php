<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'etat_commande',
        'montant_total',
        'reference',
    ];

    // Définition des constantes pour les états de commande
    const ETAT_COMMANDE_VALIDE = 'valide';
    const ETAT_COMMANDE_EN_COURS = 'en_cours';
    const ETAT_COMMANDE_ANNULE = 'annule';
    
    public function produits()
    {
        return $this->belongsToMany(Produit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
