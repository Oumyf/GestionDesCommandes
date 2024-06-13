<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-5 mb-4">Votre Panier</h1>
    @if($isEmpty)
        <div class="alert alert-info" role="alert">
            Votre panier est vide.
        </div>
    @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Produit</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($PanierItems as $item)
                <tr>
                    <td>{{ $item->produit->designation }}</td>
                    <td>{{ $item->produit->prix_unitaire }}</td>
                    <td>{{ $item->quantite }}</td>
                    <td>{{ $item->produit->prix_unitaire * $item->quantite }}</td>
                    <td>
                        <form action="{{ route('panier.supprimer', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <a href="{{ route('commande.passer') }}" class="btn btn-primary">Passer la commande</a>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
