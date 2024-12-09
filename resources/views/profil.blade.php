<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Profil utilisateur</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body class="align-items-center w-100">
        @include('menuPrincipal')

        <main class="align-items-center w-100">
            <div class="card w-25 mx-auto mt-5 mb-5">
                <div class="card-body align-items-center text-center">
                    <h1 class="mb-3 card-title">
                        Profil
                    </h1>
                    <div class="text-start">
                        <div class="row row-cols-2">
                            <b class="col-auto">Email :</b>
                            <p class="col">{{ $infosUtilisateur->emailUtilisateur }}</p>
                        </div>
                        <div class="row row-cols-2">
                            <b class="col-auto">Nom :</b>
                            <p class="col">{{ $infosUtilisateur->nomUtilisateur }}</p>
                        </div>
                        <div class="row row-cols-2">
                            <b class="col-auto">Prénom :</b>
                            <p class="col">{{ $infosUtilisateur->prenomUtilisateur }}</p>
                        </div>
                        <div class="row row-cols-2">
                            <b class="col-auto">Inscrit le :</b>
                            <p class="col">{{ date("d/m/Y à H:i", strtotime($inscription)) }}</p>
                        </div>
                        <div class="row row-cols-2">
                            <b class="col-auto">Dernière connexion le :</b>
                            <p class="col">{{ date("d/m/Y à H:i", strtotime($connexion)) }}</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a class="btn btn-primary" href="{{ route('deconnexion') }}">Se déconnecter</a>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>