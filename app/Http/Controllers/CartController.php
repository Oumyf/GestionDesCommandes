<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->with('items.produit')->first();
        return view('paniers.index', compact('cart'));
    }

    public function add(Request $request, Produit $produit)
    {
        if (!Auth::check()) {
            session(['url.intended' => route('cart.index')]);
            return redirect()->route('connexion')->with('error', 'Vous devez être connecté pour ajouter des produits au panier.');
        }

        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = $cart->items()->where('produit_id', $produit->id)->first();

        if ($item) {
            $item->quantite += $request->quantite;
            $item->save();
        } else {
            $cart->items()->create([
                'produit_id' => $produit->id,
                'quantite' => $request->quantite,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier');
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier');
    }
}
