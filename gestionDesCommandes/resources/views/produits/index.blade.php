<!-- resources/views/produits/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des produits</h1>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>
    <table class="table table-bordered">
        <thead>
            <tr>
              <th>Image</th>
                <th>Référence</th>
                <th>Désignation</th>
                <th>Prix Unitaire</th>
                <th>État</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr>
                    <td>{{ $produit->image }}</td>
                    <td>{{ $produit->reference }}</td>
                    <td>{{ $produit->designation }}</td>
                    <td>{{ $produit->prix_unitaire }}</td>
                    <td>{{ $produit->etat_produit }}</td>
                    <td>{{ $produit->categorie->libelle }}</td>
                    <td>
                        <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-info">Détails</a>
                        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
