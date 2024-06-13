<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function ajouter(Request $request)
    {
        $produit = Produit::find($request->produit_id);
        $panier = new Panier();
        $panier->addProduit($produit->id, 1); // Ajouter un produit avec une quantité de 1
        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès');
    }
    public function index()
    {
        $panier = new Panier();
        $PanierItems = [];
        $isEmpty = true;
    
        if ($panier) {
            $PanierItems = $panier->getContent() ?? [];
            $isEmpty = empty($PanierItems);
        }
    
        return view('Panier.index', compact('PanierItems', 'isEmpty'));
    }
    
    public function getContent(){
        
    }
    
    

    public function supprimer(Request $request)
    {
        $panier = new Panier();
        $panier->removeProduit($request->produit_id); // Supprimer un produit du panier
        return redirect()->back()->with('success', 'Produit supprimé du panier avec succès');
    }
}
