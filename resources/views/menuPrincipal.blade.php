{{-- Menu principal situé en haut de toutes les pages --}}

@php
    $isAuth = isset($_COOKIE["auth"]);
    $isNotAuth = !(isset($_COOKIE["auth"]));
    $isNotConnected = !(session()->has("connexion")) && !(isset($_COOKIE["auth"]));
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('accueil') }}">Authentification</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'disabled' => $isAuth,
                ]) href="{{ route('connexion') }}">Se connecter</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'disabled' => $isAuth,
                ]) href="{{ route('inscription') }}">S'inscrire</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'disabled' => $isAuth,
                ]) href="{{ route('motDePasseOublie') }}">Mot de passe oublié</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'disabled' => $isNotConnected,
                ]) href="{{ route('deconnexion') }}">Déconnexion</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'disabled' => $isNotAuth,
                ]) href="{{ route('profil') }}">Profil</a>
            </li>
        </ul>
      </div>
    </div>
</nav>