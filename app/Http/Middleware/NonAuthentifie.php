<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Utilisateur;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class NonAuthentifie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // On vérifie la présence du cookie d'authentification
		if(isset($_COOKIE["auth"])) {
			// Tentative de déchiffrement du cookie de connexion
			try {
				// Récupération des infos du JWT contenus dans le cookie.
				$cle = "T3mUjGjhC6WuxyNGR2rkUt2uQgrlFUHx";
				$jwt = JWT::decode($_COOKIE["auth"], new Key($cle, 'HS256'));
				$infosAuth = (array) $jwt;
				// Vérification de l'existance du compte utilisateur à partir de l'ID de l'utilisateur contenu dans le JWT
				if(Utilisateur::where("idUtilisateur", $infosAuth["sub"])->count() > 0) {
                    // L'utilisateur déjà authentifié n'a pas à accéder à cette page et doit être redirigé vers son profil
                    return redirect()->to('profil')->send();
				}
				else {
					// Si l'utilisateur n'existe plus : on détruit le cookie d'authentification
					setcookie("auth", "", time()-3600);
					return $next($request);
				}
			}
			catch(Exception $ex) {
				// Si le déchiffrement est un échec alors c'est que le cookie est malformé, on détruit le cookie
				setcookie("auth", "", time()-3600);
				return $next($request);
			}
		}
		else {
			// Redirection vers la page :
            return $next($request);
		}
    }
}
