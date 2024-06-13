<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/produits', [ProduitController::class, 'Listeproduit'])->name('produit.liste');
Route::get('/produit/ajouter', [ProduitController::class, 'ajouterproduit'])->name('produit.ajouter');
Route::post('/produit/ajouter', [ProduitController::class, 'ajouterproduitTraitement'])->name('produit.ajouterproduit');
Route::get('/produit/{id}', [ProduitController::class, 'afficher_details'])->name('produit.details');
Route::get('/produit/modifier/{id}', [ProduitController::class, 'modifierproduit'])->name('produit.modifier');
Route::post('/produit/modifier/{id}', [ProduitController::class, 'modifierproduitTraitement'])->name('produit.modifierproduit');
Route::delete('/produit/supprimer/{id}', [ProduitController::class, 'supprimerproduit'])->name('produit.supprimer');

// Routes pour les catégories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategorieController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/destroy/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

// Routes pour les commandes
Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
// Route::get('/commandes/{id}', [CommandeController::class, 'show'])->name('commandes.show');
Route::get('/commandes/{id}/edit', [CommandeController::class, 'edit'])->name('commandes.edit');
Route::put('/commandes/{id}', [CommandeController::class, 'update'])->name('commandes.update');
Route::delete('/commandes/{id}', [CommandeController::class, 'destroy'])->name('commandes.destroy');

// Routes pour l'authentification
Route::get('/inscription', [AuthController::class, 'inscription'])->name('inscription');
Route::post('/inscription', [AuthController::class, 'inscriptionPost'])->name('inscription');

Route::get('/connexion', [AuthController::class, 'connexion'])->name('connexion');
Route::post('/connexion', [AuthController::class, 'connexionPost'])->name('connexion');


Route::get('/index', [AccueilController::class, 'index'])->name('index');
Route::delete('/deconnexion', [AuthController::class, 'deconnexion'])->name('deconnexion');


    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{produit}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/commande', [CommandeController::class, 'index'])->name('commande.index');



