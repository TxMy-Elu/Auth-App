<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Log;
use App\Models\Recuperation;

class RecuperationCompte extends Controller
{
    public function afficherFormulaireChangementMotDePasse() {
        $ok = false; // Booléen qui permet de savoir si le code passé en GET dans l'URL est vérifié ou non
        $messageErreur = ""; // Chaine de caractères contenant le message d'erreur à afficher

        /* A FAIRE (fiche 4, question 3) : vérification du code dans l'URL ainsi que de l'expiration du lien */

        if($ok === true) {
            return view('formulaireChangementMotDePasse', ["codeRecuperation" => $_GET["code"]]);
        }
        else {
            return view('pageErreur', ["messageErreur" => $messageErreur]);
        }
    }

    public function afficherFormulaireRecuperation() {
        return view('formulaireRecuperation', []);
    }

    public function boutonRecuperer() {
		if(isset($_POST["boutonRecuperer"])) {
            $messagesErreur = array(); // Tableau contenant les messages d'erreur à afficher

			/* A FAIRE (fiche 4, question 2) : vérification de l'adresse mail saisie par l'utilisateur + envoi de mail de récupération du compte */

		}
	}

    public function boutonChangerMotDePasse() {
        // Note : $_POST["boutonChangerMotDePasse"] contient le code passé dans l'URL

        if(isset($_POST["boutonChangerMotDePasse"])) {
            $validationFormulaire = true; // Booléen qui indique si les données du formulaire sont valides
            $messagesErreur = array(); // Tableau contenant les messages d'erreur à afficher

            if(Recuperation::estValide($_POST["boutonChangerMotDePasse"]) === false) {
                $messagesErreur[] = "Le lien de réactivation a expiré.";
                $validationFormulaire = false;
            }

			/* A FAIRE (fiche 4, question 3) : vérification de la validité du mot de passe */

            if($validationFormulaire === false) {
                return view('formulaireChangementMotDePasse', ["messagesErreur" => $messagesErreur, "codeRecuperation" => $_POST["boutonChangerMotDePasse"]]);
            }
            else {
                $utilisateurConcerne = Utilisateur::find(Recuperation::where("codeRecuperation", $_POST["boutonChangerMotDePasse"])->first()->idUtilisateur); // Récupère l'utilisateur concerné par le changement de mot de passe

                /* A FAIRE (fiche 4, question 3) : changer le mot de passe de l'utilisateur */

                return view('confirmation', [ "messageConfirmation" => "Mot de passé modifié avec succès !" ]);
            }
		}
    }
}
