<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Liste des Commandes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
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

<div class="container mt-5">
  <h1 class="text-center mb-4">Liste des Commandes</h1>
  <a href="{{ route('commandes.create') }}" class="btn btn-primary mb-3">Ajouter une Commande</a>

  @if(session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Référence</th>
        <th>État de la Commande</th>
        <th>Montant Total</th>
        <th>Date de la Commande</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($commandes as $commande)
      <tr>
        <td>{{ $commande->id }}</td>
        <td>{{ $commande->reference }}</td>
        <td>{{ $commande->etat_commande }}</td>
        <td>{{ $commande->montant_total }}</td>
        <td>{{ $commande->created_at }}</td>
        <td>
          <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-info btn-sm">Modifier</a>
          <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">Supprimer</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
