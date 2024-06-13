<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD IN LARAVEL 11</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f8f9fa;
            margin: 20px;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background: #ff0464;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        .content {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
        }
        .table-container {
            margin: 20px 0;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .icon {
            font-size: 1.2em;
            margin: 0 5px;
            color: #333;
        }
        .icon:hover {
            color: #007bff;
        }
        .container {
            max-width: 1400px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .header-title {
            color: #007bff;
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 10px;
        }
        .create-btn {
            background-color: #007bff;
            border-color: #007bff;
        }
        .create-btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .prod1{
            background-color: #e63387;
            color: #f8f9fa;
            margin-left: 900px;
        }
    </style>
    <!-- FontAwesome pour les icônes -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center py-4">Tableau de bord</h2>
        <nav class="nav flex-column">
            <a class="nav-link" href="#">Accueil</a>
            <a class="nav-link prod" href="{{ route('produit.liste') }}">Mes Produits</a>
            <a class="nav-link" href="{{ route('categories.index') }}">Mes Catégories</a>
            <a class="nav-link" href="{{ route('commandes.index') }}">Mes Commandes</a>
        </nav>
    </div>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <hr>
                <a href="/produit/ajouter" class="btn prod1">Ajouter des produits</a>
                <hr>
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Désignation</th>
                                <th>Référence</th>
                                <th>Date de création</th>
                                <th>État</th>
                                <th>Prix Unitaire</th>
                                <th>Utilisateur</th>
                                <th>Catégorie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits as $produit)
                                <tr>
                                    <td><img src="{{ $produit->image }}" alt="{{ $produit->designation }}" height="40"></td>
                                    <td>{{ $produit->designation }}</td>
                                    <td>{{ $produit->reference }}</td>
                                    <td>{{ $produit->created_at }}</td>
                                    <td>{{ $produit->etat_produit }}</td>
                                    <td>{{ $produit->prix_unitaire }}</td>
                                    <td>{{ $produit->user->nom }}</td>
                                    <td>{{ $produit->categorie->libelle }}</td>
                                    <td>
                                        <a href="/produit/modifier/{{$produit->id}}" class="icon" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('produit.supprimer', $produit->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon btn btn-link p-0" title="Supprimer" style="color: inherit;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="#" class="icon" title="Voir les détails" data-bs-toggle="modal" data-bs-target="#detailsModal" data-id="{{$produit->id}}">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour les détails -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Détails du produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenu dynamique des détails du produit -->
                    <div id="modalContent"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var detailsModal = document.getElementById('detailsModal');
            detailsModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var productId = button.getAttribute('data-id');

                // Faire une requête AJAX pour obtenir les détails du produit
                fetch('/produit/details/' + productId)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('modalContent').innerHTML = data;
                    });
            });
        });
    </script>
</body>
</html>
