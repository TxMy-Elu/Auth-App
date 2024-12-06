<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Erreur</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body class="align-items-center w-100">
        <?php echo $__env->make('menuPrincipal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main class="align-items-center w-100">
            <form method="POST" action="<?php echo e(route('validationChangementMotDePasse')); ?>" class="card w-25 mx-auto mt-5 mb-5">
                <?php echo csrf_field(); ?>
                <div class="card-body align-items-center text-center">
                    <h1 class="mb-3 card-title">
                        Erreur
                    </h1>
                    <div class="alert alert-danger mb-3 text-start" role="alert">
                        <b><?php echo e($messageErreur); ?></b>
                    </div>
                    <div>
                        <a href="<?php echo e(route('connexion')); ?>">Se connecter</a>
                    </div>
                </div>
            </form>
        </main>
    </body>
</html><?php /**PATH /var/www/html/auth-app/resources/views/pageErreur.blade.php ENDPATH**/ ?>