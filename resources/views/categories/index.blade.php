<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
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
    .btn-group .btn {
        margin: 0 5px;
    }
    .btn-group {
        display: flex;
        justify-content: center;
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

    }</style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center py-4">Tableau de bord</h2>
        <nav class="nav flex-column">
            <a class="nav-link" href="#">Accueil</a>
            <a class="nav-link" href="{{ route('produit.liste') }}">Mes Produits</a>
            <a class="nav-link" href="{{ route('categories.index') }}">Mes Catégories</a>
            <a class="nav-link" href="{{ route('commandes.index') }}">Les Commandes</a>
    
        </nav>
    </div>
    <div class="container">
        <h1 class="text-center header-title">Catégories</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('categories.create') }}" class="btn create-btn text-white">Ajouter une catégorie</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Libelle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)
                        <tr>
                            <td>{{ $categorie->id }}</td>
                            <td>{{ $categorie->libelle }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-primary">Modifier</a>
                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
