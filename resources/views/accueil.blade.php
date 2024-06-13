<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kane & Frères - Gestion des Produits Alimentaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style>
       .card {
    height: 100%;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.button {
  --width: 100px;
  --height: 35px;
  --tooltip-height: 35px;
  --tooltip-width: 90px;
  --gap-between-tooltip-to-button: 18px;
  --button-color: #222;
  --tooltip-color: #fff;
  width: var(--width);
  height: var(--height);
  background: var(--button-color);
  position: relative;
  text-align: center;
  border-radius: 0.5em;
  font-family: "Arial";
  transition: background 0.7s;
}

.button::before {
  position: absolute;
  content: attr(data-tooltip);
  width: var(--tooltip-width);
  height: var(--tooltip-height);
  background-color: #555;
  font-size: 0.9rem;
  color: #fff;
  border-radius: 0.25em;
  line-height: var(--tooltip-height);
  bottom: calc(var(--height) + var(--gap-between-tooltip-to-button) + 10px);
  left: calc(50% - var(--tooltip-width) / 2);
}

.button::after {
  position: absolute;
  content: "";
  width: 0;
  height: 0;
  border: 10px solid transparent;
  border-top-color: #555;
  left: calc(50% - 10px);
  bottom: calc(100% + var(--gap-between-tooltip-to-button) - 10px);
}

.button::after,
.button::before {
  opacity: 0;
  visibility: hidden;
  transition: all 0.5s;
}

.text {
  display: flex;
  align-items: center;
  justify-content: center;
}

.button-wrapper,
.text,
.icon {
  overflow: hidden;
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  color: #fff;
}

.text {
  top: 0;
}

.text,
.icon {
  transition: top 0.5s;
}

.icon {
  color: #fff;
  top: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon svg {
  width: 24px;
  height: 24px;
}

.button:hover {
  background: #222;
}

.button:hover .text {
  top: -100%;
}

.button:hover .icon {
  top: 0;
}

.button:hover:before,
.button:hover:after {
  opacity: 1;
  visibility: visible;
}

.button:hover:after {
  bottom: calc(var(--height) + var(--gap-between-tooltip-to-button) - 20px);
}

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Kane & Frères</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produit.liste') }}">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('commandes.index') }}">Commandes</a>
                    </li>
                @endauth
            </ul>
            @auth
                <form action="{{ route('deconnexion') }}" method="POST" class="d-flex" role="search">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Déconnexion</button>
                </form>
            @else
                <a class="btn btn-primary" href="{{ route('connexion') }}">Connexion</a>
                <a class="btn btn-secondary ms-2" href="{{ route('inscription') }}">Inscription</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-5">
    @auth
        <div class="alert alert-success">
            <h4>Bienvenue, {{ Auth::user()->nom }}!</h4>
        </div>
        @endauth

   
        <div class="row">
            @foreach($produits as $produit)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $produit->image }}" class="card-img-top" alt="{{ $produit->designation }}" height="350">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produit->designation }}</h5>
                            <p class="card-text">{{ $produit->description }}</p>
                            <p class="card-text"><strong>Prix:</strong> {{ $produit->prix_unitaire }} FCFA</p>
                            <div class="button" data-tooltip="{{ $produit->prix_unitaire }}">
                              <div class="button-wrapper">
                                <div class="text">Ajouter au panier</div>
                                <span class="icon">
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-cart2"
                                    viewBox="0 0 16 16"
                                  >
                                    <path
                                      d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"
                                    ></path>
                                  </svg>
                                </span>
                              </div>
                            </div>
                            
                            <form action="{{ route('cart.add', $produit) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="quantite" class="form-label">Quantité</label>
                                    <input type="number" class="form-control" id="quantite" name="quantite" value="1" min="1" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</div>

<footer class="bg-light text-center text-lg-start mt-5">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Kane & Frères</h5>
                <p>
                    Nous sommes spécialisés dans la vente de produits alimentaires. Notre application vous permet de gérer efficacement vos produits, catégories, et commandes.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Liens Utiles</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="{{ route('produit.liste') }}" class="text-dark">Produits</a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="text-dark">Catégories</a>
                    </li>
                    <li>
                        <a href="{{ route('commandes.index') }}" class="text-dark">Commandes</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Contact</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <p class="text-dark">Email: contact@kaneetfreres.com</p>
                    </li>
                    <li>
                        <p class="text-dark">Téléphone: +123 456 7890</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center p-3 bg-dark text-white">
        © 2024 Kane & Frères
    </div>
</footer>
</body>
</html>
