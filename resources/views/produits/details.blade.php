<!-- resources/views/produit/details.blade.php -->
<div>
    <p><strong>Désignation :</strong> {{ $produit->designation }}</p>
    <p><strong>Référence :</strong> {{ $produit->reference }}</p>
    <p><strong>Date de création :</strong> {{ $produit->created_at }}</p>
    <p><strong>État :</strong> {{ $produit->etat_produit }}</p>
    <p><strong>Prix Unitaire :</strong> {{ $produit->prix_unitaire }}</p>
    <p><strong>Utilisateur :</strong> {{ $produit->user->nom }}</p>
    <p><strong>Catégorie :</strong> {{ $produit->categorie->libelle }}</p>
    <img src="{{ $produit->image }}" alt="{{ $produit->designation }}" class="img-fluid" height="300px">
</div>
