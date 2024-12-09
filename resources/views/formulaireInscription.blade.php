<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inscription</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body class="align-items-center w-100">
        @include('menuPrincipal')

        <main class="align-items-center w-100">
            <form method="POST" action="{{ route('validationFormulaireInscription') }}" class="card w-50 mx-auto mt-5 mb-5">
                @csrf
                <div class="card-body align-items-center text-center">
                    <h1 class="mb-3 card-title">
                        Inscription
                    </h1>
                    @include('messageErreur')
                    <div>
                        <div class="mb-3">
                            <i>Tous les champs sont obligatoires</i>
                        </div>
                        <!-- A FAIRE (fiche 2, partie 1, question 2) : création du formulaire d'inscription -->
                        <!-- CORRIGÉ -->
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nom" placeholder="Nom..." required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="prenom" placeholder="Prénom..." required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Adresse email..." required>
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
                        <div class="card mb-3 text-start">
                            <div class="card-body">
                                <h5 class="card-title">Conditions d'utilisation des données à caractère personnel :</h5>
                                <p>
                                    Les informations recueillies sur ce formulaire sont enregistrées dans un fichier informatisé par <strong>M. Tom DOGUET</strong> pour <strong>l'authentification des utilisateurs</strong>. La base légale du traitement est <strong>le consentement</strong>.
                                    <br/><br/>
                                    Les données collectées <strong>ne seront communiquées à aucun tiers</strong>.
                                    <br/><br/>
                                    Les données sont conservées pendant <strong>2 ans</strong>.
                                    <br/><br/>
                                    Vous pouvez accéder aux données vous concernant, les rectifier, demander leur effacement ou exercer votre droit à la limitation du traitement de vos données.
                                    <br/><br/>
                                    Consultez le site <a href="https://www.cnil.fr">cnil.fr</a> pour plus d’informations sur vos droits.
                                    <br/><br/>
                                    Pour exercer ces droits ou pour toute question sur le traitement de vos données dans ce dispositif, vous pouvez contacter <strong>notre délégué à la protection des données</strong> : <strong>Tom DOGUET to.doguet@gmail.com</strong>
                                    <br/><br/>
                                    Si vous estimez, après nous avoir contactés, que vos droits « Informatique et Libertés » ne sont pas respectés, vous pouvez adresser une réclamation à la CNIL.
                                </p>
                            </div>
                        </div>
                        <div class="input-group mb-3 form-check">
                            <input class="form-check-input me-3" type="checkbox" required id="acceptation">
                            <label class="form-check-label" for="acceptation">
                                J'accepte les conditions d'utilisation de mes données à caractère personnel
                            </label>                          
                        </div>
                    </div>
                    <div class="input-group d-grid gap-2">
                        <button class="btn btn-primary btn-lg" type="submit" name="boutonInscription">Valider</button>
                    </div>
                </div>
            </form>
        </main>
    </body>
</html>