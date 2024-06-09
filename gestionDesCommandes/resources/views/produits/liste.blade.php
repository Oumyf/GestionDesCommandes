<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD IN LARAVEL 11</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container text-center">
  <div class="row">
    <div class="col">
      <h1>Liste des Produits</h1>
      <hr>
      <a href="/ajouter" class="btn btn-primary mb-3">Ajouter des produits</a>
      <hr>
      @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="table-dark">
            <tr>
              <th>Image</th>
              <th>Référence</th>
              <th>Désignation</th>
              <th>Prix Unitaire</th>
              <th>État du Produit</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($Produits as $produit)
            <tr>
              <td><img src="{{ $produit->image }}" alt="{{ $produit->reference }}" height="50"></td>
              <td>{{ $produit->reference }}</td>
              <td>{{ $produit->designation }}</td>
              <td>{{ $produit->prix_unitaire }}</td>
              <td>{{ $produit->etat_produit ? 'Disponible' : ($produit->etat_produit ? 'En rupture' : 'En stock') }}</td>
              <td>
                <a href="/modifierProduit/{{ $produit->id }}" class="btn btn-info btn-sm">Modifier</a>
                <a href="/supprimerProduit/{{ $produit->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bien ?');">Supprimer</a>
                <a href="{{ route('produits.details', $produit->id) }}" class="btn btn-primary btn-sm">Voir les détails</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
