<!-- resources/views/produits/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le produit</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="reference">Référence</label>
            <input type="text" class="form-control" id="reference" name="reference" value="{{ $produit->reference }}" required>
        </div>
        <div class="form-group">
            <label for="designation">Désignation</label>
            <input type="text" class="form-control" id="designation" name="designation" value="{{ $produit->designation }}" required>
        </div>
        <div class="form-group">
            <label for="prix_unitaire">Prix Unitaire</label>
            <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" value="{{ $produit->prix_unitaire }}" required>
        </div>
        <div class="form-group">
            <label for="etat_produit">État du Produit</label>
            <select class="form-control" id="etat_produit" name="etat_produit" required>
                <option value="">Sélectionnez un état</option>
                @foreach($etatProduits as $etat)
                    <option value="{{ $etat }}" {{ $produit->etat_produit == $etat ? 'selected' : '' }}>{{ ucfirst($etat) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <small>Si vous ne souhaitez pas changer l'image, laissez ce champ vide.</small>
        </div>
        <div class="form-group">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select class="form-select" id="categorie_id" name="categorie_id" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" @if($bien->categorie_id == $categorie->id) selected @endif>{{ $categorie->libelle }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <a href="{{ route('produits.index') }}" class="btn btn-secondary mt-3">Retour à la liste des produits</a>
</div>
@endsection
