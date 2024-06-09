<?php
namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('/categories.index', compact('categories'));
    }

    public function ajouter()
    {
        return view('/categories.ajouter');
    }

    public function sauvegarder(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
        ]);

        Categorie::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succés.');
    }

    public function afficher()
    {
        $categories = Categorie::all();
        return view('/categories.index', compact('categories'));
    }

    public function modifier($id)
    {
        $categories = Categorie::all();
        $categorie = Categorie::findOrFail($id);
        return view('/categories.modifier', compact('categorie','categories'));
    }

    public function modifierCategorie(Request $request, Categorie $categorie)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        $categorie->update($request->all());
        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie modifiée avec succés.');
    }

    public function supprimer($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie supprimée avec succés .');
    }
}
