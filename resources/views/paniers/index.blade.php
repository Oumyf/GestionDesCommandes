<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #007bff;
            margin-bottom: 30px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .total {
            font-size: 1.5em;
            font-weight: bold;
            color: #28a745;
        }
        .alert {
            margin-top: 20px;
        }
        .empty-cart {
            text-align: center;
            margin-top: 50px;
            font-size: 1.2em;
            color: #6c757d;
        }
        .product-img {
            max-height: 50px;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Mon Panier</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($cart && $cart->items->count() > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->items as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->produit->image_url }}" alt="{{ $item->produit->designation }}" class="product-img">
                                {{ $item->produit->designation }}
                            </td>
                            <td>{{ $item->quantite }}</td>
                            <td>{{ $item->produit->prix_unitaire }} €</td>
                            <td>{{ $item->quantite * $item->produit->prix_unitaire }} €</td>
                            <td>
                                <form action="{{ route('cart.remove', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Retirer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total text-end">
                Total: {{ $cart->items->sum(fn($item) => $item->quantite * $item->produit->prix_unitaire) }} €
            </div>
        @else
            <p class="empty-cart">Votre panier est vide</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
