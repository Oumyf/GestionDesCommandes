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
        $categories = Categorie::all(); // Récupère toutes les catégories de la base de données
        $users = User::all(); // Récupère toutes les catégories de la base de données
        return view('Produits.ajouter', compact('categories', 'users'));
    }

    public function sauvegarder(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string',
            'statut' => 'required|in:occupe,pas_occupe',
            'image' => 'required',
            'categorie_id' => 'required|exists:categories,id',

        ]);

        // Initialisation de la variable pour le chemin de l'image
        $image = null;
        // Vérifier si un fichier image est uploadé
        if ($request->hasFile('image')) {
            // Stocker l'image dans le répertoire 'public/blog'
            $chemin_image = $request->file('image')->store('public/blog');

            // Vérifier si le chemin de l'image est Produit généré
            if (!$chemin_image) {
                return redirect()->back()->with('error', "Erreur lors du téléchargement de l'image.");
            }

            // Récupérer le nom du fichier de limage
            $image = basename($chemin_image);
        }


        Produit::create($validatedData);

        return redirect()->back()->with('status', "Le Produit a été ajouté avec succès");
    }

    public function Afficher()
    {
        $Produits = Produit::all();
        return view('Produits.listeProduits', compact('Produits'));
    }

    public function afficher_details($id){
        $categories = Categorie::all();
        $Produit = Produit::findOrFail($id);
        return view('Produits.details', compact('Produit', 'categories'));
    }


    public function modifier($id)
    {
        $categories = Categorie::all();
        $Produit = Produit::findOrFail($id);
        return view('Produits.modifier', compact('Produit', 'categories'));

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

        return redirect()->back()->with('status', "Le Produit a Produit été supprimé avec succès");
    }
}
