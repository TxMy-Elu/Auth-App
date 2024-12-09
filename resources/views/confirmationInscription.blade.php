<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Confirmation de l'inscription</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body class="align-items-center w-100">
        @include('menuPrincipal')

        <main class="align-items-center w-100">
            <form method="POST" action="{{ route('validationChangementMotDePasse') }}" class="card w-50 mx-auto mt-5 mb-5">
                @csrf
                <div class="card-body align-items-center text-center">
                    <h1 class="mb-3 card-title">
                        Confirmation de l'inscription
                    </h1>
                    <div class="alert alert-success mb-3 text-start" role="alert">
                        <b>Inscription effectuée avec succès !</b>
                    </div>
                    <div class="card container">
                        <h2 class="mt-3">AVANT DE CONTINUER : configurez la double authentifcation !</h2>
                        <div class="row row-cols-2 card-body">
                            <div class="col">
                                <img src="data:image/png;base64, {{ $qrCode }}"/>
                            </div>
                            <div class="col-6">
                                <p>
                                    A l'aide d'une application d'authentifcation (A2F) comme <a href="https://authy.com/download/">Authy</a> ou <strong>Google Authenticator</strong> (<a href="https://apps.apple.com/app/google-authenticator/id388497605">iOS</a> ou <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">Android</a>), scannez le QR-Code ci-contre afin de vous connecter à votre compte.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('connexion') }}">Se connecter</a>
                    </div>
                </div>
            </form>
        </main>
    </body>
</html>