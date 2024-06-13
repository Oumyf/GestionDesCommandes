<?php

namespace App\Http\Controllers;


use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    // Afficher le formulaire pour ajouter un produit
    public function create()
    {
        $categories = Categorie::all();
        $etatProduits = Produit::distinct()->pluck('etat_produit');
        return view('produits.create', compact('categories', 'etatProduits'));
    }

    // Sauvegarder un nouveau produit
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'reference' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric',
            'etat_produit' => 'required|in:disponible,en_rupture,en_stock',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        Produit::create($validatedData);

        return redirect()->route('produits.index')->with('status', "Le produit a été ajouté avec succès.");
    }

    // Afficher tous les produits
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    // Afficher les détails d'un produit spécifique
    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.show', compact('produit'));
    }

    // Afficher le formulaire pour modifier un produit
    public function edit($id)
    {
        $categories = Categorie::all();
        $etatProduits = Produit::distinct()->pluck('etat_produit');
        $produit = Produit::findOrFail($id);
        return view('produits.edit', compact('categories', 'produit', 'etatProduits'));
    }

    // Sauvegarder les modifications apportées à un produit
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reference' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric',
            'etat_produit' => 'required|in:disponible,en_rupture,en_stock',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit = Produit::findOrFail($id);

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        } else {
            $validatedData['image'] = $produit->image;
        }

        $produit->update($validatedData);

        return redirect()->route('produits.index')->with('status', "Le produit a bien été modifié avec succès.");
    }

    // Supprimer un produit
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('status', "Le produit a bien été supprimé avec succès.");
    }
}
