<!-- formulaireConnexion.blade.php -->
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Connexion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body class="align-items-center w-100">
<?php echo $__env->make('menuPrincipal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="align-items-center w-100">
    <form method="POST" action="<?php echo e(route('validationFormulaireConnexion')); ?>" class="card w-50 mx-auto mt-5 mb-5">
        <?php echo csrf_field(); ?>
        <div class="card-body align-items-center text-center">
            <h1 class="mb-3 card-title">
                Connexion
            </h1>
            <?php echo $__env->make('messageErreur', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if(isset($tentativesRestantes)): ?>
                <div class="alert alert-warning">
                    Il vous reste <?php echo e($tentativesRestantes); ?> tentatives avant que votre compte ne soit désactivé.
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Mot de passe" name="motdepasse" required>
            </div>
            <div class="mb-3 d-grid gap-2">
                <button class="btn btn-primary btn-lg" type="submit" name="boutonConnexion">Connexion</button>
            </div>
            <div class="d-flex flex-row align-items-center">
                <a href="<?php echo e(route('inscription')); ?>" class="btn btn-secondary me-auto">S'inscrire</a>
                <a href="<?php echo e(route('motDePasseOublie')); ?>">Mot de passe oublié ?</a>
            </div>
        </div>
    </form>
</main>
</body>
</html><?php /**PATH /var/www/html/auth-app2/resources/views/formulaireConnexion.blade.php ENDPATH**/ ?>