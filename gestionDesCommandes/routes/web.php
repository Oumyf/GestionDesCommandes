<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produits',[ProduitController::class,'afficher']);

Route::get('/produits/{id}',[ProduitController::class,'Afficher_details'])->name('produits.details');

Route::get('/ajouter',[ProduitController::class,'ajouter']);
Route::post('/ajouterProduit',[ProduitController::class,'sauvegarder'])->name('produits.ajouter');

Route::get('/modifierProduit/{id}',[ProduitController::class,'modifier'])->name('produits.modifier');
Route::post('/modifierProduit',[ProduitController::class,'sauvegardeModif']);

Route::get('/supprimerProduit/{id}',[ProduitController::class,'supprimer']);

// Route::get('/produits/search/{nom}',[ProduitController::class,'rechercher']);
// Route::get('/produits/tri/{ordre}',[ProduitController::class,'tri']);
