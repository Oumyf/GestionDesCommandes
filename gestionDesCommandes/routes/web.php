<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produits',[ProduitController::class,'afficher']);

Route::post('/produits/{id}',[ProduitController::class,'Affichage_details']);



Route::get('/ajouterProduit',[ProduitController::class,'ajouter']);

Route::post('/ajouterProduit/{id}',[ProduitController::class,'sauvegarder']);



Route::get('/modifierProduit',[ProduitController::class,'modifier']);

Route::put('/modifierProduit/{id}',[ProduitController::class,'sauvegardeModif']);



Route::delete('/supprimerProduit/{id}',[ProduitController::class,'supprimer']);




// Route::get('/produits/search/{nom}',[ProduitController::class,'rechercher']);

// Route::get('/produits/tri/{ordre}',[ProduitController::class,'tri
// ']);

