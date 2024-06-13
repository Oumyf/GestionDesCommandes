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

    public function create()
    {
        return view('/categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
        ]);

        Categorie::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succés.');
    }

    public function show(Categorie $categorie)
    {
        return view('/categories.show', compact('categorie'));
    }

    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categories = Categorie::all();
        return view('/categories.edit', compact('categorie','categories'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        $categorie->update($request->all());
        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie modifiée avec succés.');
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie supprimée avec succés .');
    }
}
