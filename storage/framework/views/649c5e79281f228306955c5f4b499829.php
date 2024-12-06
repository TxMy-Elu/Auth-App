

<?php
    $isAuth = isset($_COOKIE["auth"]);
    $isNotAuth = !(isset($_COOKIE["auth"]));
    $isNotConnected = !(session()->has("connexion")) && !(isset($_COOKIE["auth"]));
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo e(route('accueil')); ?>">Authentification</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'nav-link',
                    'disabled' => $isAuth,
                ]); ?>" href="<?php echo e(route('connexion')); ?>">Se connecter</a>
            </li>
            <li class="nav-item">
                <a class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'nav-link',
                    'disabled' => $isAuth,
                ]); ?>" href="<?php echo e(route('inscription')); ?>">S'inscrire</a>
            </li>
            <li class="nav-item">
                <a class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'nav-link',
                    'disabled' => $isAuth,
                ]); ?>" href="<?php echo e(route('motDePasseOublie')); ?>">Mot de passe oublié</a>
            </li>
            <li class="nav-item">
                <a class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'nav-link',
                    'disabled' => $isNotConnected,
                ]); ?>" href="<?php echo e(route('deconnexion')); ?>">Déconnexion</a>
            </li>
            <li class="nav-item">
                <a class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'nav-link',
                    'disabled' => $isNotAuth,
                ]); ?>" href="<?php echo e(route('profil')); ?>">Profil</a>
            </li>
        </ul>
      </div>
    </div>
</nav><?php /**PATH /var/www/html/auth-app/resources/views/menuPrincipal.blade.php ENDPATH**/ ?>