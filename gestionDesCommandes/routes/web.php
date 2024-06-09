<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;

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


Route::get('/categories',[CategorieController::class,'afficher'])->name('categories.index');

Route::get('/ajouter',[CategorieController::class,'ajouter'])->name('categories.ajouter');
Route::post('/ajouterCategorie',[CategorieController::class,'sauvegarder'])->name('categories.sauvegarder');

Route::get('/modifierCategorie/{id}',[CategorieController::class,'modifier'])->name('categories.modifier');
Route::put('/modifierCategorie', [CategorieController::class, 'modifier'])->name('categories.modifier');

Route::delete('/supprimerCategorie/{id}',[CategorieController::class,'supprimer'])->name('categories.supprimer');

// Route::get('/produits/search/{nom}',[ProduitController::class,'rechercher']);
// Route::get('/produits/tri/{ordre}',[ProduitController::class,'tri']);
