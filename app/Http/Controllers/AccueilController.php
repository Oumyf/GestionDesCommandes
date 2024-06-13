<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index (){
        $produits = Produit::all();
        return view('accueil',compact('produits'));
    }

    
}
