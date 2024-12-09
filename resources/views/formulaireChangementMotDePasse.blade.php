<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Changement du mot de passe</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body class="align-items-center w-100">
        @include('menuPrincipal')

        <main class="align-items-center w-100">
            <form method="POST" action="{{ route('validationChangementMotDePasse') }}" class="card w-25 mx-auto mt-5 mb-5">
                @csrf
                <div class="card-body align-items-center text-center">
                    <h1 class="mb-3 card-title">
                        Changement du mot de passe
                    </h1>
                    @include('messageErreur')
                    <div class="mb-3 text-start">
                        <i>Renseignez un nouveau mot de passe pour votre compte utilisateur :</i>
                    </div>
                    <div class="mb-3 row g-2 align-items-center">
                        <div class="col">
                            <input type="password" class="form-control col-auto" name="motDePasse1" placeholder="Mot de passe..." required>
                        </div>
                        <div class="col-auto">
                            <span class="form-text col-auto">
                                Minimum 13 caractères
                            </span> 
                        </div>                         
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control col-auto" name="motDePasse2" placeholder="Confirmer le mot de passe..." required>                      
                    </div>
                    <div class="input-group mb-3 d-grid gap-2">
                        <button class="btn btn-primary btn-lg" type="submit" value="{{ $codeRecuperation }}" name="boutonChangerMotDePasse">Valider</button>
                    </div>
                </div>
            </form>
        </main>
    </body>
</html>