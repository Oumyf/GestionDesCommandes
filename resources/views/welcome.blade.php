<!DOCTYPE html>
<html>
<head>
    <title>Laravel et Bootstrap - Sidebar</title>
    @vite('resources/css/app.css')
    <style>
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center py-4">Tableau de bord</h2>
        <nav class="nav flex-column">
            <a class="nav-link" href="#">Accueil</a>
            <a class="nav-link" href="{{ route('produit.liste') }}">Mes Produits</a>
            <a class="nav-link" href="{{ route('categories.index') }}">Mes Catégories</a>
            <a class="nav-link" href="{{ route('commandes.index') }}">Mes Commandes</a>
    
        </nav>
    </div>
    <div class="content">
        <div class="alert alert-success" role="alert">
            Bootstrap est intégré avec succès dans votre projet Laravel !
        </div>
        <div class="card mt-4">
            <div class="card-body">
                Ceci est un exemple de carte Bootstrap.
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
