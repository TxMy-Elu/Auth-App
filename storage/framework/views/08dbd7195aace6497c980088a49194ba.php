<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Double authentification</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body class="align-items-center w-100">
        <?php echo $__env->make('menuPrincipal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main class="align-items-center w-100">
            <form method="POST" action="<?php echo e(route('validationFormulaireConnexion')); ?>" class="card w-25 mx-auto mt-5 mb-5">
                <?php echo csrf_field(); ?>
                <div class="card-body align-items-center text-center">
                    <h1 class="mb-3 card-title">
                        Double authentification
                    </h1>
                    <?php echo $__env->make('messageErreur', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <label for="codeA2F" class="form-label">Entrez le code envoyé par votre application d'authentification :</label>
                    <div class="input-group mb-3">
                        <input type="text" id="codeA2F" class="form-control" placeholder="Code" name="codeA2F" required>
                    </div>
                    <div class="input-group d-grid gap-2 mb-3">
                        <button class="btn btn-primary btn-lg" type="submit" name="boutonVerificationCodeA2F">Valider</button>
                    </div>
                    <div class="input-group align-items-center">
                        <a href="<?php echo e(route('deconnexion')); ?>" class="btn btn-secondary mx-auto" type="submit" name="boutonDeconnexion">Se déconnecter</a>
                    </div>
                </div>
            </form>
        </main>
    </body>
</html><?php /**PATH /var/www/html/auth-app/resources/views/formulaireA2F.blade.php ENDPATH**/ ?>