<!-- resources/views/produits/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du produit</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $produit->designation }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Référence : </strong>{{ $produit->reference }}</p>
            <p><strong>Prix Unitaire : </strong>{{ $produit->prix_unitaire }}</p>
            <p><strong>État : </strong>{{ ucfirst($produit->etat_produit) }}</p>
            <p><strong>Catégorie : </strong>{{ $produit->categorie->libelle }}</p>
            <p><strong>Image : </strong></p>
            <img src="{{ asset('images/' . $produit->image) }}" alt="{{ $produit->designation }}" class="img-fluid">
        </div>
    </div>
    <a href="{{ route('produits.index') }}" class="btn btn-secondary mt-3">Retour à la liste des produits</a>
</div>
@endsection
