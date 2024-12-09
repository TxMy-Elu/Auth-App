<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Log;
use App\Models\Reactivation;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

/* A FAIRE (fiche 2, partie 2, question 2) : inclure ci-dessous les use PHP pour les librairies gérant l'A2F */


class Inscription extends Controller
{
    public function afficherFormulaireInscription() {
        return view('formulaireInscription', []);
    }

    public function boutonInscription() {
        if(isset($_POST["boutonInscription"])) {
            $validationFormulaire = true; // Booléen qui indique si les données du formulaire sont valides
            $messagesErreur = array(); // Tableau contenant les messages d'erreur à afficher

            /* A FAIRE (fiche 2, partie 1, question 6) : vérification du formulaire d'inscription */

            // CORRIGÉ
            if(Utilisateur::existeEmail($_POST["email"])) {
                $messagesErreur[] = "Cette adresse email a déjà été utilisée";
                $validationFormulaire = false;
            }
            if($_POST["motDePasse1"] != $_POST["motDePasse2"]) {
                $messagesErreur[] = "Les deux mots de passe saisis ne sont pas identiques";
                $validationFormulaire = false;
            }
            if(preg_match("/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[!@#%^&*()\$_+÷%§€\-=\[\]{}|;':\",.\/<>?~`]).{12,}$/", $_POST["motDePasse1"]) === 0) {
                $messagesErreur[] = "Le mot de passe doit contenir au minimum 12 caractères comportant au moins une minuscule, une majuscule, un chiffre et un caractère spécial.";
                $validationFormulaire = false;
            }


            if($validationFormulaire === false) {
                return view('formulaireInscription', ["messagesErreur" => $messagesErreur]);
            }
            else {
                $google2fa = new Google2FA();

                $secret= $google2fa->generateSecretKey();
                $email=$_POST["email"];
                $google2fa = app(Google2FA::class);

                $g2faUrl = $google2fa->getQRCodeUrl(
                    'auth-app',
                    $email,
                    $secret
                );

                $writer = new Writer(
                    new ImageRenderer(
                        new RendererStyle(400),
                        new ImagickImageBackEnd()
                    )
                );

                $qrCode = base64_encode($writer->writeString($g2faUrl));



                /* A FAIRE (fiche 2, partie 1, question 7) : on inscrit l'utilisateur dans la base + écriture dans les logs */

                // CORRIGÉ
                $motDePasseHashe = password_hash($_POST["motDePasse1"], PASSWORD_BCRYPT);
                Utilisateur::inscription($_POST["email"], $motDePasseHashe, $_POST["nom"], $_POST["prenom"], $secret);
                Log::ecrireLog($_POST["email"], "Inscription");

                return view('confirmationInscription', ["qrCode" => $qrCode]);
            }
        }
    }
}
