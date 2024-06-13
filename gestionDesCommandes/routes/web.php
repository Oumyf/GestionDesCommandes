<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
 use App\Http\Controllers\CategorieController;

Route::get('/', function () {
    return view('welcome');
});

// Routes pour les produits
Route::get('/products', [ProduitController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProduitController::class, 'show'])->name('products.show');
Route::get('/products/create', [ProduitController::class, 'create'])->name('products.create');
Route::post('/products', [ProduitController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProduitController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProduitController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProduitController::class, 'destroy'])->name('products.destroy');

// Routes pour les catégories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategorieController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/destroy/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

// Routes pour le panier et les commandes
Route::post('/cart/add', [PanierController::class, 'add'])->name('cart.add');
Route::get('/cart', [PanierController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [PanierController::class, 'remove'])->name('cart.remove');
Route::post('/order', [OrderController::class, 'store'])->name('orders.store');


