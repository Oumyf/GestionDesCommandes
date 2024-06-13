<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Panier;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function sauvegarder(Request $request)
    {
        // Validation des données si nécessaire
        $request->validate([
            'user_id' => 'required|exists:users,id',
            // Ajoutez d'autres validations si nécessaire
        ]);

        // Récupérer les articles du panier
        $panier = Panier::where('user_id', $request->user_id)->get();

        if ($panier->isEmpty()) {
            return redirect()->route('produits.index')->with('error', 'Votre panier est vide.');
        }

        // Calculer le prix total
        $prixTotal = $panier->sum(function ($item) {
            return $item->produit->prix * $item->quantite;
        });

        // Créer la commande
        $commande = Commande::create([
            'user_id' => $request->user_id,
            'prix_total' => $prixTotal,
            // Ajoutez d'autres champs si nécessaire
        ]);

        // Associer les articles du panier à la commande
        foreach ($panier as $item) {
            $commande->produits()->attach($item->produit_id, ['quantite' => $item->quantite]);
        }

        // Vider le panier
        Panier::where('user_id', $request->user_id)->delete();

        return redirect()->route('produits.index')->with('success', 'Commande passée avec succès !');
    }
}
