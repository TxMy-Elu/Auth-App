<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Reactivation;
use App\Models\Utilisateur;

/* A FAIRE (fiche 3, partie 2, question 1) : inclure ci-dessous le use PHP pour la libriairie gérant l'A2F */

use PragmaRX\Google2FA\Google2FA;

// A FAIRE (fiche 3, partie 3, question 4) : inclure ci-dessous le use PHP pour la libriairie gérant le

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Connexion extends Controller
{
    public function afficherFormulaireConnexion()
    {
        return view('formulaireConnexion', []);
    }

    public function afficherFormulaireVerificationA2F()
    {
        if (session()->has('connexion')) {
            if (Utilisateur::where("idUtilisateur", session()->get('connexion'))->count() > 0) {
                return view('formulaireA2F', []);
            } else {
                session()->forget('connexion');
                return view('formulaireConnexion', []);
            }
        } else {
            return view('formulaireConnexion', []);
        }
    }

    public function reactivationCompte()
    {
        $validation = false; // Booléen vrai/faux si les conditions de vérification sont remplies pour réactiver le compte
        $messageAAfficher = null; // Contient le message d'erreur ou de succès à afficher

        // Vérification du code dans l'URL ainsi que de l'expiration du lien + réactivation du compte
        if (isset($_GET["code"])) {
            $code = $_GET["code"];
            $reactivation = Reactivation::where("codeReactivation", $code)->first();
            if ($reactivation !== null) {
                if (Reactivation::estValide($code)) { // Pass the $code argument
                    $utilisateur = Utilisateur::find($reactivation->idUtilisateur);
                    $utilisateur->reactiverCompte();
                    $reactivation->delete();
                    $messageAAfficher = "Votre compte a été réactivé avec succès";
                    $validation = true;
                } else {
                    $messageAAfficher = "Le lien de réactivation a expiré";
                }
            } else {
                $messageAAfficher = "Le lien de réactivation est invalide";
            }
        } else {
            $messageAAfficher = "Le lien de réactivation est invalide";
        }
        echo $messageAAfficher;
        if ($validation === false) {
            return view("pageErreur", ["messageErreur" => $messageAAfficher]);
        } else {
            return view('confirmation', ["messageConfirmation" => $messageAAfficher]);
        }
    }

    public function boutonVerificationCodeA2F()
    {
        $validationFormulaire = false; // Booléen qui indique si les données du formulaire sont valides
        $messagesErreur = array(); // Tableau contenant les messages d'erreur à afficher

        $google2fa = new Google2FA();
        $utilisateur = Utilisateur::find(session()->get('connexion'));

        if ($utilisateur !== null) {
            $secret = $utilisateur->secretA2FUtilisateur;
            if ($google2fa->verifyKey($secret, $_POST["codeA2F"])) {
                session()->forget('connexion');
                $validationFormulaire = true;
                Log::ecrireLog($utilisateur->emailUtilisateur, "Connexion");

            } else {
                $messagesErreur[] = "Code A2F incorrect";
                $validationFormulaire = false;
                Log::ecrireLog($utilisateur->emailUtilisateur, "Connexion échouée");

            }
        } else {
            $messagesErreur[] = "Utilisateur non trouvé";
            echo "Utilisateur non trouvé";
            Log::ecrireLog("Utilisateur inconnu", "Connexion échouée");
        }

        /* A FAIRE (fiche 3, partie 3, question 4) : générer un JWT une fois le code A2F validé + création du cookie + redirection vers la page de profil */

        if ($validationFormulaire === true) {
            $cle = "T3mUjGjhC6WuxyNGR2rkUt2uQgrlFUHx";
            $payload = [
                "iss" => "http://172.17.0.12:9000",
                "sub" => $utilisateur->idUtilisateur,
                "iat" => time(),
                "exp" => time() + 3600 // 1 hour
            ];
            $jwt = JWT::encode($payload, $cle, 'HS256'); // Pass the algorithm as the third argument
            setcookie("auth", $jwt, time() + 3600, "/", "", false, true);
            Log::ecrireLog($utilisateur->emailUtilisateur, "Connexion réussie");
            return redirect()->to('profil')->send();
        } else {
            Log::ecrireLog($utilisateur->emailUtilisateur, "Connexion échouée");
            return view('formulaireA2F', ["messagesErreur" => $messagesErreur]);
        }

    }

    public
    function boutonConnexion()
    {
        $validationFormulaire = false; // Booléen qui indique si les données du formulaire sont valides
        $messagesErreur = array(); // Tableau contenant les messages d'erreur à afficher
        $tentativesRestantes = 5; // Nombre de tentatives restantes

        if (Utilisateur::where("emailUtilisateur", $_POST["email"])->count() === 0) {
            $messagesErreur[] = "Adresse email inconnue";
            $validationFormulaire = false;
        } else {
            $utilisateur = Utilisateur::where("emailUtilisateur", $_POST["email"])->first();
            $tentativesRestantes = 5 - $utilisateur->tentativesEchoueesUtilisateur; // Retrieve failed attempts from the database

            if ($utilisateur->estDesactiveUtilisateur === 1) {
                $messagesErreur[] = "Votre compte a été désactivé";
                $validationFormulaire = false;
            } else {
                if (password_verify($_POST["motdepasse"], $utilisateur->motDePasseUtilisateur) === false) {
                    $messagesErreur[] = "Mot de passe incorrect";
                    $utilisateur->tentativesEchoueesUtilisateur += 1;
                    $tentativesRestantes = 5 - $utilisateur->tentativesEchoueesUtilisateur;
                    if ($utilisateur->tentativesEchoueesUtilisateur >= 5) {
                        $utilisateur->desactiverCompte();
                        $messagesErreur[] = "Votre compte a été désactivé après 5 tentatives échouées";

                        $codeReactivation = Reactivation::creerCodeReactivation($utilisateur);

                        $message = "Bonjour " . $utilisateur->prenomUtilisateur . " " . $utilisateur->nomUtilisateur . ",<br><br>";
                        $message .= "Votre compte a été désactivé suite à 5 tentatives de connexion échouées.<br>";
                        $message .= "Pour réactiver votre compte, veuillez cliquer sur <a href='http://172.17.0.12:9000/reactivation?code=" . $codeReactivation . "'>ce lien</a>.<br><br>";
                        $message .= "Cordialement,<br>L'équipe de développement";
                        Email::envoyerEmail($utilisateur->emailUtilisateur, "Réactivation de votre compte", $message);

                        Log::ecrireLog($utilisateur->emailUtilisateur, "Désactivation");
                    }
                    $utilisateur->save();
                    $validationFormulaire = false;
                } else {
                    $validationFormulaire = true;
                    $utilisateur->tentativesEchoueesUtilisateur = 0; // Reset failed attempts on successful login
                    $utilisateur->save();
                    session()->put('connexion', $utilisateur->idUtilisateur);
                    Log::ecrireLog($utilisateur->emailUtilisateur, "Connexion");
                }
            }
        }

        if ($validationFormulaire === false) {
            return view('formulaireConnexion', ["messagesErreur" => $messagesErreur, "tentativesRestantes" => $tentativesRestantes]);
        } else {
            return view('formulaireA2F', []);
        }
    }

    public
    function deconnexion()
    {
        if (session()->has('connexion')) {
            session()->forget('connexion');
        }
        if (isset($_COOKIE["auth"])) {
            setcookie("auth", "", time() - 3600);
        }

        return redirect()->to('connexion')->send();
    }

    public
    function validationFormulaire()
    {
        if (isset($_POST["boutonVerificationCodeA2F"])) {
            return $this->boutonVerificationCodeA2F();
        } else {
            if (isset($_POST["boutonConnexion"])) {
                return $this->boutonConnexion();
            } else {
                return redirect()->to('connexion')->send();
            }
        }
    }
}