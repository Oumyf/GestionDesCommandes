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
        <h1>CRUD DANS LARAVEL 11</h1>
        <hr>
        <a href="/ajouter" class="btn btn-primary mb-3">Ajouter des produits</a>
        <hr>
        @if(session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        <div class="row">
          @foreach($Produits as $produit)
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="{{ $produit->image }}" class="card-img-top" alt="{{ $produit->reference }}" height="300">
                <div class="card-body">
                  <h5 class="card-title">{{ $produit->designation }}</h5>
                  {{-- <p class="card-text">{{ $produit->description }}</p> --}}
                  <p class="card-text"><small class="text-muted">{{ $produit->prix_unitaire }}</small></p>
                  <p class="card-text"><strong>Statut:</strong> {{ $produit->etat_produit ? 'disponible' : ($produit->etat_produit ? 'en_rupture' : 'en_stock') }}</p>
                  <a href="/modifierProduit/{{ $produit->id }}" class="btn btn-info">Modifier</a>
                  <a href="/supprimerProduit/{{ $produit->id }}" class="btn btn-danger">Supprimer</a>
                  <a href="{{ route('produits.details', $produit->id) }}" class="btn btn-primary">Voir les détails</a>                </div>

                  <br>
                  <br>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
