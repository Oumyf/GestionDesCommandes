<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitCommandeController extends Controller
{
    // Afficher les produits d'une commande spécifique
    public function index($commandeId)
    {
        $commande = Commande::with('produits')->findOrFail($commandeId);
        return view('produit_commande.index', compact('commande'));
    }

    // Afficher le formulaire pour ajouter un produit à une commande
    public function create($commandeId)
    {
        $produits = Produit::all();
        return view('produit_commande.create', compact('commandeId', 'produits'));
    }

    // Sauvegarder un produit dans une commande
    public function store(Request $request, $commandeId)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $commande = Commande::findOrFail($commandeId);
        $commande->produits()->attach($request->produit_id, ['quantite' => $request->quantite]);

        return redirect()->route('produit_commande.index', $commandeId)->with('success', 'Produit ajouté à la commande avec succès.');
    }

    // Afficher le formulaire pour modifier un produit dans une commande
    public function edit($commandeId, $produitId)
    {
        $commande = Commande::findOrFail($commandeId);
        $produit = $commande->produits()->where('produit_id', $produitId)->firstOrFail();
        return view('produit_commande.edit', compact('commande', 'produit'));
    }

    // Mettre à jour un produit dans une commande
    public function update(Request $request, $commandeId, $produitId)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $commande = Commande::findOrFail($commandeId);
        $commande->produits()->updateExistingPivot($produitId, ['quantite' => $request->quantite]);

        return redirect()->route('produit_commande.index', $commandeId)->with('success', 'Produit mis à jour dans la commande avec succès.');
    }

    // Supprimer un produit d'une commande
    public function destroy($commandeId, $produitId)
    {
        $commande = Commande::findOrFail($commandeId);
        $commande->produits()->detach($produitId);

        return redirect()->route('produit_commande.index', $commandeId)->with('success', 'Produit supprimé de la commande avec succès.');
    }
}
