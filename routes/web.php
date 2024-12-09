<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Connexion;
use App\Http\Controllers\Inscription;
use App\Http\Controllers\Profil;
use App\Http\Controllers\RecuperationCompte;
use App\Http\Middleware\Authentification;
use App\Http\Middleware\NonAuthentifie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Connexion::class, 'afficherFormulaireConnexion'])->middleware([NonAuthentifie::class])->name('accueil');

Route::get('/connexion', [Connexion::class, 'afficherFormulaireConnexion'])->middleware([NonAuthentifie::class])->name('connexion');
Route::post('/connexion', [Connexion::class, 'validationFormulaire'])->middleware([NonAuthentifie::class])->name('validationFormulaireConnexion');

Route::get('/inscription', [Inscription::class, 'afficherFormulaireInscription'])->middleware([NonAuthentifie::class])->name('inscription');
Route::post('/inscription', [Inscription::class, 'boutonInscription'])->middleware([NonAuthentifie::class])->name('validationFormulaireInscription');

Route::get('/motDePasseOublie', [RecuperationCompte::class, 'afficherFormulaireRecuperation'])->name('motDePasseOublie');
Route::post('/motDePasseOublie', [RecuperationCompte::class, 'boutonRecuperer'])->name('validationEmailMotDePasseOublie');

Route::get('/reinitialisation', [RecuperationCompte::class, 'afficherFormulaireChangementMotDePasse'])->name('reinitialisation');
Route::post('/reinitialisation', [RecuperationCompte::class, 'boutonChangerMotDePasse'])->name('validationChangementMotDePasse');

Route::get('/reactivation', [Connexion::class, 'reactivationCompte'])->name('reactivation');

Route::get('/deconnexion', [Connexion::class, 'deconnexion'])->name('deconnexion');

Route::get('/profil', [Profil::class, 'afficherPageProfil'])->middleware([Authentification::class])->name('profil');