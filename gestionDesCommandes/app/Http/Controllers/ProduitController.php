<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function ajouter()
    {
        $produits = Produit::all(); // Récupère toutes les catégories de la base de données
        $categories = Categorie::all(); // Récupère toutes les catégories de la base de données
        $etat_produits = Produit::distinct()->pluck('etat_produit');
        return view('produits.ajouter', compact('categories','produits','etat_produits'));
    }

    public function sauvegarder(Request $request)
    {
        $validatedData = $request->validate([
            'reference' => 'required|string|max:255',
            'designation' => 'required|string',
            'prix_unitaire' => 'required|integer',
            'etat_produit' => 'required|in:disponible,en_rupture,en_stock',
            'image' => 'required',
            'categorie_id' => 'required|exists:categories,id',

        ]);

      


        Produit::create($validatedData);

        return redirect()->back()->with('status', "Le Produit a été ajouté avec succès");
    }

    public function Afficher()
    {
        $Produits = Produit::all();
        return view('produits.liste', compact('Produits'));
    }

    public function afficher_details($id){
        $categories = Categorie::all();
        $Produits = Produit::findOrFail($id);
        return view('Produits.details', compact('Produits', 'categories'));
    }


    public function modifier($id)
    {
        $categories = Categorie::all();
        $Produits = Produit::findOrFail($id);
        return view('Produits.modifier', compact('Produits', 'categories'));

    }

    public function sauvegardeModif(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'statut' => 'required',
            'image' => 'required',
        ]);
        $Produit = Produit::find($request->id);
        $Produit->nom = $request->nom;
        $Produit->description = $request->description;
        $Produit->image = $request->image;
        $Produit->statut = $request->statut;
        $Produit->update();
        return redirect('/Produits')->with('status', "Le Produit a bien été modifié avec succès");
    }

    public function supprimer($id)
    {
        $Produit = Produit::findOrFail($id);
        $Produit->delete();

        return redirect()->back()->with('status', "Le Produit a bien été supprimé avec succès");
    }
}
