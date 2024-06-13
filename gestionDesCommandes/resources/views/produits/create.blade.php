<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un bien</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .form-container {
      max-width: 600px;
      margin: auto;
      margin-top: 50px;
    }
    .form-container h1 {
      text-align: center;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="form-container">
        <h1>Ajouter un produit</h1>

        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="reference" class="form-label">Référence</label>
            <input type="text" class="form-control" id="reference" name="reference">
          </div>
          <div class="mb-3">
            <label for="designation" class="form-label">Désignation</label>
            <textarea class="form-control" id="designation" name="designation" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
    <input type="text" class="form-control" id="image" name="image"  required>
  </div>
          <div class="mb-3">
            <label for="prix_unitaire" class="form-label">Prix unitaire</label>
            <input type="text" class="form-control" id="prix_unitaire" name="prix_unitaire">
          </div>
          <div class="mb-3">
            <label for="etat_produit" class="form-label">Etat du Produit</label>
            <select class="form-select" id="etat_produit" name="etat_produit" required>
                @foreach($etat_produits as $etat_produit)
                    <option value="{{ $etat_produit }}">{{ $etat_produit }}</option>
                @endforeach
            </select>
        </div>
        
        
          <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select class="form-select" id="categorie_id" name="categorie_id" required>
              @foreach($categories as $categorie)
              <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
              @endforeach
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Ajouter un produit</button>
          </div>
        </form>
        <div class="mt-3 text-center">
          <a href="/produits" class="btn btn-danger">Retour</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
