<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
}

.form_area {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: #EDDCD9;
  height: auto;
  width: auto;
  border: 2px solid #264143;
  border-radius: 20px;
  box-shadow: 3px 4px 0px 1px #E99F4C;
}

.title {
  color: #264143;
  font-weight: 900;
  font-size: 1.5em;
  margin-top: 20px;
}

.sub_title {
  font-weight: 600;
  margin: 5px 0;
}

.form_group {
  display: flex;
  flex-direction: column;
  align-items: baseline;
  margin: 10px;
}

.form_style {
  outline: none;
  border: 2px solid #264143;
  box-shadow: 3px 4px 0px 1px #E99F4C;
  width: 290px;
  padding: 12px 10px;
  border-radius: 4px;
  font-size: 15px;
}

.form_style:focus, .btn:focus {
  transform: translateY(4px);
  box-shadow: 1px 2px 0px 0px #E99F4C;
}

.btn {
  padding: 15px;
  margin: 25px 0px;
  width: 290px;
  font-size: 15px;
  background: #DE5499;
  border-radius: 10px;
  font-weight: 800;
  box-shadow: 3px 3px 0px 0px #E99F4C;
}

.btn:hover {
  opacity: .9;
}

.link {
  font-weight: 800;
  color: #264143;
  padding: 5px;
}
    </style>
</head>
<body>
<div class="row justify-content-center mt-5">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Connexion</h1>
            </div>
            <div class="card-body">
                @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <form action="{{ route('connexion') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="adiaoumyf@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="mot_de_passe" class="form-label">Mot de passe</label>
                        <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe" required>
                    </div>
                    <div class="mb-3">
                        <div class="d-grid">
                            <button class="btn btn-primary">Se connecter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



</body>
</html>
