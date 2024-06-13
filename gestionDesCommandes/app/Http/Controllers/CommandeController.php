<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('produits')->get();
        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
        $produits = Produit::all();
        return view('commandes.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|array',
            'produit_id.*' => 'exists:produits,id',
            'quantite' => 'required|array',
            'quantite.*' => 'integer|min:1',
        ]);

        $commande = Commande::create([
            'prix_total' => $request->prix_total
        ]);

        $produits = [];
        foreach ($request->produit_id as $index => $produitId) {
            $produits[$produitId] = ['quantite' => $request->quantite[$index]];
        }

        $commande->produits()->attach($produits);

        return redirect()->route('commandes.index')->with('status', 'Commande ajoutée avec succès !');
    }

    public function edit(Commande $commande)
    {
        $produits = Produit::all();
        return view('commandes.edit', compact('commande', 'produits'));
    }

    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'produit_id' => 'required|array',
            'produit_id.*' => 'exists:produits,id',
            'quantite' => 'required|array',
            'quantite.*' => 'integer|min:1',
        ]);

        $commande->update([
            'prix_total' => $request->prix_total
        ]);

        $produits = [];
        foreach ($request->produit_id as $index => $produitId) {
            $produits[$produitId] = ['quantite' => $request->quantite[$index]];
        }

        $commande->produits()->sync($produits);

        return redirect()->route('commandes.index')->with('status', 'Commande mise à jour avec succès !');
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')->with('status', 'Commande supprimée avec succès !');
    }
}
