<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .form-control {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Modifier une Categorie</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('categories.modifier', $categorie->id) }}" method="POST">
            @csrf
            @method('PUT')
       
            <div class="form-group">
                <label for="categorie" class="form-label">Sélectionner une Catégorie</label>
                <select name="categorie_id" id="categorie" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $categorie->id ? 'selected' : '' }}>
                            {{ $cat->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Modifier</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Liste des Catégories</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
